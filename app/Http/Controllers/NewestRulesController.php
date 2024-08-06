<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use App\Models\MonografiHukum;
use App\Models\ArtikelHukum;
use App\Models\PutusanPengadilan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewestRulesController extends Controller
{
    public function beranda()
    {
        $dokumenTerbaru = DB::table('produk_hukums')
            ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("'produk_hukum' as tipe"))
            ->union(DB::table('monografi_hukums')
                ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("'monografi_hukum' as tipe")))
            ->union(DB::table('artikel_hukums')
                ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("'artikel_hukum' as tipe")))
            ->union(DB::table('putusan_pengadilans')
                ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("'putusan_pengadilan' as tipe")))
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $jumlahProdukHukum = DB::table('produk_hukums')->count();
        $jumlahMonografiHukum = DB::table('monografi_hukums')->count();
        $jumlahArtikelHukum = DB::table('artikel_hukums')->count();
        $jumlahPutusanPengadilan = DB::table('putusan_pengadilans')->count();

        return view('JDIH.beranda', compact('dokumenTerbaru', 'jumlahProdukHukum', 'jumlahMonografiHukum', 'jumlahArtikelHukum', 'jumlahPutusanPengadilan'));
    }
}
