<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\PembayaranLunas;
use App\Models\Periksa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Periksa::with([
                'daftarPoli.pasien',
                'daftarPoli.jadwalPeriksa.dokter'
            ])
            ->where(function ($query) {
                $query->whereNotNull('bukti_pembayaran')
                      ->orWhere('status_pembayaran', 'ditolak');
            })
            ->latest('tgl_pembayaran')
            ->get();

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function konfirmasi(string $id)
    {
        $berhasil = DB::transaction(function () use ($id) {
            $periksa = Periksa::with('daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter.poli')
                ->lockForUpdate()
                ->findOrFail($id);

            if (!$periksa->bukti_pembayaran || $periksa->status_pembayaran === 'lunas') {
                return false;
            }

            $periksa->update(['status_pembayaran' => 'lunas']);
            $namaPoli = $periksa->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli ?? 'poliklinik';
            $periksa->daftarPoli->pasien->notify(new PembayaranLunas($periksa->id, $namaPoli));

            return true;
        });

        if (!$berhasil) {
            return back()->with('error', 'Bukti pembayaran belum ada atau sudah dikonfirmasi.');
        }

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function tolak(string $id)
    {
        $periksa = Periksa::findOrFail($id);

        if (!$periksa->bukti_pembayaran) {
            return back()->with('error', 'Bukti pembayaran tidak ditemukan.');
        }

        if (Storage::disk('public')->exists($periksa->bukti_pembayaran)) {
            Storage::disk('public')->delete($periksa->bukti_pembayaran);
        }

        $periksa->update([
            'bukti_pembayaran'  => null,
            'status_pembayaran' => 'ditolak',
            'tgl_pembayaran'    => null,
        ]);

        return back()->with('success', 'Bukti pembayaran ditolak. Pasien bisa upload ulang.');
    }
}