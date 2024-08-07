<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use App\Models\ArtikelHukum;
use App\Models\MonografiHukum;
use App\Models\PutusanPengadilan;

class ProdukHukumController extends Controller
{
    public function cari(Request $request)
    {
        $keyword = $request->input('cariKeyword');
        $tipeDokumen = $request->input('tipeDokumen');
        $jenisDokumen = $request->input('jenisDokumen');
        $tahun = $request->input('cariTahun');
        $nomor = $request->input('cariNomor');
        $status = $request->input('status');

        $produkHukum = ProdukHukum::query();
        $artikelHukum = ArtikelHukum::query();
        $monografiHukum = MonografiHukum::query();
        $putusanPengadilan = PutusanPengadilan::query();

        if ($keyword) {
            $produkHukum->where('judul', 'like', '%' . $keyword . '%');
            $artikelHukum->where('judul', 'like', '%' . $keyword . '%');
            $monografiHukum->where('judul', 'like', '%' . $keyword . '%');
            $putusanPengadilan->where('judul', 'like', '%' . $keyword . '%');
        }

        if ($tipeDokumen) {
            if ($tipeDokumen == 'Peraturan Perundang-Undangan') {
                $produkHukum->where('tipe_dokumen', $tipeDokumen);
            } elseif ($tipeDokumen == 'Artikel Hukum') {
                $artikelHukum->where('tipe_dokumen', $tipeDokumen);
            } elseif ($tipeDokumen == 'Monografi Hukum') {
                $monografiHukum->where('tipe_dokumen', $tipeDokumen);
            } elseif ($tipeDokumen == 'Putusan Pengadilan') {
                $putusanPengadilan->where('tipe_dokumen', $tipeDokumen);
            }
        }

        if ($jenisDokumen) {
            $produkHukum->where('jenis_dokumen', $jenisDokumen);
        }

        if ($tahun) {
            $produkHukum->where('tahun', $tahun);
            $artikelHukum->where('tahun', $tahun);
            $monografiHukum->where('tahun', $tahun);
            $putusanPengadilan->where('tahun', $tahun);
        }

        if ($nomor) {
            $produkHukum->where('nomor', $nomor);
        }

        if ($status) {
            $produkHukum->where('status_dokumen', $status);
        }

        $hasilPencarian = $produkHukum->get()->merge($artikelHukum->get())->merge($monografiHukum->get())->merge($putusanPengadilan->get());

        return view('JDIH.hasil-pencarian', compact('hasilPencarian'));
    }
}
