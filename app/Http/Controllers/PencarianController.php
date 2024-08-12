<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ProdukHukum;
use App\Models\PutusanPengadilan;
use App\Models\ArtikelHukum;
use App\Models\MonografiHukum;

class PencarianController extends Controller
{
    public function cari(Request $request)
    {
        $keyword = $request->input('keyword');
        $tahun = $request->input('cariTahun');
        $nomor = $request->input('cariNomor');
        $status = $request->input('status');

        $sort = $request->input('sort', 'newest');

        $hasilPencarian = collect();

        $models = [ProdukHukum::class, PutusanPengadilan::class, ArtikelHukum::class, MonografiHukum::class];

        foreach ($models as $model) {
            $query = $model::query();

            if ($keyword) {
                $query->where('judul', 'like', "%$keyword%");
            }

            if ($tahun) {
                $query->whereYear('tanggal_pengundangan', $tahun);
            }

            if ($nomor) {
                $query->where('judul', 'like', "%$nomor%");
            }

            if ($status) {
                $query->where('status_dokumen', $status);
            }

            $hasilPencarian = $hasilPencarian->concat($query->get());
        }

        if ($sort == 'oldest') {
            $hasilPencarian = $hasilPencarian->sortBy('tanggal_pengundangan');
        } else {
            $hasilPencarian = $hasilPencarian->sortByDesc('tanggal_pengundangan');
        }

        $hasilPencarian = DB::table('produk_hukums')
            ->select(DB::raw("id as id"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'produk_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen"))
            ->union(DB::table('monografi_hukums')
                ->select(DB::raw("id as id"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'monografi_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")))
            ->union(DB::table('artikel_hukums')
                ->select(DB::raw("id as id"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'artikel_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")))
            ->union(DB::table('putusan_pengadilans')
                ->select(DB::raw("id as id"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'putusan_pengadilan' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")))
            ->get(); // Execute the query and get the results as a collection

        $noResults = $hasilPencarian->isEmpty();

        $hasilPencarian = new \Illuminate\Pagination\LengthAwarePaginator(
            $hasilPencarian->forPage($request->page, 10),
            $hasilPencarian->count(),
            10,
            $request->page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        return view('JDIH.hasil-pencarian', ['hasilPencarian' => $hasilPencarian, 'noResults' => $noResults]);
    }
}
