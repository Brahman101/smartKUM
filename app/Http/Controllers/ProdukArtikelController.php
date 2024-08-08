<?php

namespace App\Http\Controllers;


use App\Models\ProdukHukum;
use App\Models\MonografiHukum;
use App\Models\ArtikelHukum;
use App\Models\PutusanPengadilan;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProdukArtikelController extends Controller
{
    public function artikelHukum()
    {
        $artikelHukum = DB::table('produk_hukums')
            ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"))
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menggunakan pagination dengan 10 data per halaman

        foreach ($artikelHukum as $item) {
            $produkHukum = ProdukHukum::find($item->judul); // Ganti dengan kolom yang unik
            if ($produkHukum) {
                $produkHukum->jumlah_dilihat += 1;
                $produkHukum->save();
            }
        }

        foreach ($artikelHukum as $item) {
            $produkHukum = ProdukHukum::find($item->judul); // Ganti dengan kolom yang unik
            if ($produkHukum) {
                $produkHukum->jumlah_diunduh += 1;
                $produkHukum->save();
            }
        }

        return view('JDIH.artikelhukum', compact('artikelHukum'));
    }
}
