<?php

namespace App\Http\Controllers;


use App\Models\ProdukHukum;
use App\Models\MonografiHukum;
use App\Models\ArtikelHukum;
use App\Models\PutusanPengadilan;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TipeDokumenController extends Controller
{
    public function produkHukum()
    {
        $produkHukum = ProdukHukum::select('judul', 'tanggal_pengundangan', 'created_at', 'abstrak', 'jumlah_dilihat', 'jumlah_diunduh')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if (!$produkHukum->isEmpty()) {
            $produkHukum->each(function ($item) {
                $item->increment('jumlah_dilihat');
                $item->increment('jumlah_diunduh');
                $item->save();
            });
        } else {
            $produkHukum = collect();
        }

        return view('JDIH.produkhukum', compact('produkHukum'));
    }
    public function artikelHukum()
    {
        $artikelHukum = DB::table('artikel_hukums')
            ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"))
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menggunakan pagination dengan 10 data per halaman

        foreach ($artikelHukum as $item) {
            $artikelHukum = artikelHukum::find($item->judul); // Ganti dengan kolom yang unik
            if ($artikelHukum) {
                $artikelHukum->jumlah_dilihat += 1;
                $artikelHukum->save();
            }
        }

        foreach ($artikelHukum as $item) {
            $artikelHukum = artikelHukum::find($item->judul); // Ganti dengan kolom yang unik
            if ($artikelHukum) {
                $artikelHukum->jumlah_diunduh += 1;
                $artikelHukum->save();
            }
        }

        return view('JDIH.artikelhukum', compact('artikelHukum'));
    }

    public function monografiHukum()
    {
        $monografiHukum = DB::table('monografi_hukums')
            ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($monografiHukum as $item) {
            $monografiHukum = MonografiHukum::find($item->judul);
            if ($monografiHukum) {
                $monografiHukum->jumlah_dilihat += 1;
                $monografiHukum->save();
            }
        }

        foreach ($monografiHukum as $item) {
            $monografiHukum = MonografiHukum::find($item->judul);
            if ($monografiHukum) {
                $monografiHukum->jumlah_diunduh += 1;
                $monografiHukum->save();
            }
        }

        return view('JDIH.monografihukum', compact('monografiHukum'));
    }
    public function putusanPengadilan()
    {
        $putusanPengadilan = DB::table('putusan_pengadilans')
            ->select(DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($putusanPengadilan as $item) {
            $putusanPengadilan = PutusanPengadilan::find($item->judul);
            if ($putusanPengadilan) {
                $putusanPengadilan->jumlah_dilihat += 1;
                $putusanPengadilan->save();
            }
        }

        foreach ($putusanPengadilan as $item) {
            $putusanPengadilan = PutusanPengadilan::find($item->judul);
            if ($putusanPengadilan) {
                $putusanPengadilan->jumlah_diunduh += 1;
                $putusanPengadilan->save();
            }
        }

        return view('JDIH.putusanpengadilan', compact('putusanPengadilan'));
    }
}
