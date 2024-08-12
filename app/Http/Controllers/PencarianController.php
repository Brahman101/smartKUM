<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $hasilPencarian = new \Illuminate\Pagination\LengthAwarePaginator(
            $hasilPencarian->forPage($request->page, 10),
            $hasilPencarian->count(),
            10,
            $request->page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        return view('JDIH.hasil-pencarian', ['hasilPencarian' => $hasilPencarian]);
    }
}
