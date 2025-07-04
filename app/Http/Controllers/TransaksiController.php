<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index()
    {
        try {
            // Log informasi saat mengambil data transaksi
            Log::info('Menampilkan daftar transaksi');
            return view('transaksi.index', [
                'transaksis' => Transaksi::with(['pelanggan', 'produk'])->paginate(10)
            ]);
        } catch (Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error("Error mengambil data transaksi: " . $e->getMessage(), [
                'request' => request()->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('transaksi.index')->withErrors('Terjadi kesalahan saat mengambil data transaksi.');
        }
    }

    public function create()
    {
        // Log informasi saat menampilkan form transaksi
        Log::info('Menampilkan form pembuatan transaksi');
        $pelanggans = Pelanggan::all();
        $produks = Produk::where('stok', '>', 0)->get(); // Hanya tampilkan produk yang masih ada stoknya
        $penggunas = Pengguna::all();
        
        return view('transaksi.create', compact('pelanggans', 'produks', 'penggunas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        
        // Validasi stok tersedia
        if ($produk->stok < $request->jumlah) {
            Log::warning('Stok produk tidak mencukupi', [
                'produk_id' => $request->produk_id,
                'stok_tersedia' => $produk->stok,
                'jumlah_diminta' => $request->jumlah
            ]);
            return redirect()->back()
                ->withInput()
                ->withErrors(['jumlah' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $produk->stok]);
        }

        try {
            DB::beginTransaction();
            
            // Calculate total_harga
            $total_harga = $produk->harga * $request->jumlah;

            // Kurangi stok produk
            $produk->update([
                'stok' => $produk->stok - $request->jumlah
            ]);

            // Buat transaksi
            Transaksi::create([
                'pelanggan_id' => $request->pelanggan_id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'total_harga' => $total_harga,
                'status' => $request->status
            ]);

            DB::commit();

            Log::info('Transaksi berhasil ditambahkan', ['transaksi_data' => $request->all()]);

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil ditambahkan!');

        } catch (Exception $e) {
            DB::rollback();
            // Log error saat terjadi kesalahan saat membuat transaksi
            Log::error("Error membuat transaksi: " . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat transaksi: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            // Log informasi saat menampilkan detail transaksi
            Log::info('Menampilkan detail transaksi', ['id' => $id]);
            $transaksi = Transaksi::findOrFail($id);
            return view('transaksi.show', compact('transaksi'));
        } catch (Exception $e) {
            // Log error saat transaksi tidak ditemukan
            Log::error("Data transaksi tidak ditemukan: " . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('transaksi.index')->withErrors('Data transaksi tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            // Log informasi saat menampilkan form edit transaksi
            Log::info('Menampilkan form edit transaksi', ['id' => $id]);
            $transaksi = Transaksi::findOrFail($id);
            $pelanggans = Pelanggan::all();
            $produks = Produk::all();
            $penggunas = Pengguna::all();
            
            return view('transaksi.edit', compact('transaksi', 'pelanggans', 'produks', 'penggunas'));
        } catch (Exception $e) {
            // Log error saat data transaksi tidak ditemukan untuk edit
            Log::error("Terjadi kesalahan saat mengambil data transaksi untuk pengeditan: " . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('transaksi.index')->withErrors('Terjadi kesalahan saat mengambil data transaksi untuk pengeditan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:pending,proses,selesai'
        ]);

        try {
            DB::beginTransaction();

            $transaksi = Transaksi::findOrFail($id);
            $produk_lama = Produk::findOrFail($transaksi->produk_id);
            $produk_baru = Produk::findOrFail($request->produk_id);
            
            // Kembalikan stok produk lama jika produk berbeda
            if ($transaksi->produk_id != $request->produk_id) {
                $produk_lama->update([
                    'stok' => $produk_lama->stok + $transaksi->jumlah
                ]);
                
                // Cek stok produk baru
                if ($produk_baru->stok < $request->jumlah) {
                    DB::rollback();
                    Log::warning('Stok produk tidak mencukupi saat update transaksi', [
                        'produk_baru_id' => $produk_baru->id,
                        'stok_tersedia' => $produk_baru->stok,
                        'jumlah_diminta' => $request->jumlah
                    ]);
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['jumlah' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $produk_baru->stok]);
                }
                
                // Kurangi stok produk baru
                $produk_baru->update([
                    'stok' => $produk_baru->stok - $request->jumlah
                ]);
            } else {
                // Jika produk sama, hitung selisih jumlah
                $selisih = $request->jumlah - $transaksi->jumlah;
                
                // Cek apakah stok mencukupi jika ada penambahan jumlah
                if ($selisih > 0 && $produk_baru->stok < $selisih) {
                    DB::rollback();
                    Log::warning('Stok produk tidak mencukupi saat update transaksi', [
                        'produk_baru_id' => $produk_baru->id,
                        'stok_tersedia' => $produk_baru->stok,
                        'jumlah_diminta' => $selisih
                    ]);
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['jumlah' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $produk_baru->stok]);
                }
                
                // Update stok produk
                $produk_baru->update([
                    'stok' => $produk_baru->stok - $selisih
                ]);
            }
            
            // Calculate total_harga
            $total_harga = $produk_baru->harga * $request->jumlah;

            // Update transaksi
            $transaksi->update([
                'pelanggan_id' => $request->pelanggan_id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'total_harga' => $total_harga,
                'status' => $request->status
            ]);

            DB::commit();

            Log::info('Transaksi berhasil diupdate', ['transaksi_data' => $request->all()]);

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil diupdate!');

        } catch (Exception $e) {
            DB::rollback();
            // Log error saat terjadi kesalahan saat mengupdate transaksi
            Log::error("Error mengupdate transaksi: " . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate transaksi: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            // Log informasi saat menampilkan konfirmasi penghapusan transaksi
            Log::info('Menampilkan form konfirmasi penghapusan transaksi', ['id' => $id]);
            $transaksi = Transaksi::with('produk')->findOrFail($id);
            return view('transaksi.delete', compact('transaksi'));
        } catch (Exception $e) {
            // Log error saat gagal mengambil transaksi untuk penghapusan
            Log::error("Error mengambil data transaksi untuk dihapus: " . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->route('transaksi.index')->withErrors('Terjadi kesalahan saat mengambil data transaksi untuk dihapus.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $transaksi = Transaksi::findOrFail($id);
            $produk = Produk::findOrFail($transaksi->produk_id);

            // Kembalikan stok produk
            $produk->update([
                'stok' => $produk->stok + $transaksi->jumlah
            ]);

            // Hapus transaksi
            $transaksi->delete();

            DB::commit();

            // Log informasi setelah transaksi dihapus
            Log::info('Transaksi berhasil dihapus dan stok produk telah dikembalikan', ['transaksi_id' => $id]);

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus dan stok produk telah dikembalikan!');
        } catch (Exception $e) {
            DB::rollback();
            // Log error saat gagal menghapus transaksi
            Log::error("Error menghapus transaksi: " . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus transaksi: ' . $e->getMessage());
        }
    }
}
