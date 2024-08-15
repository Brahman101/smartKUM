<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianController extends Controller
{
    public function cari(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'cariTahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'cariNomor' => 'nullable|integer|min:11',
            'status' => 'nullable|string|in:Berlaku,Tidak Berlaku',
            'sort' => 'nullable|string|in:newest,oldest',
        ]);

        $keyword = $request->input('keyword');
        $tahun = $request->input('cariTahun');
        $cariNomor = $request->input('cariNomor');
        $status = $request->input('status');
        $sort = $request->input('sort', 'newest');

        $hasilPencarian = DB::table('produk_hukums')
            ->select(DB::raw("id as id"), DB::raw("nomor as nomor"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("COALESCE(CAST(abstrak AS CHAR), '') as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'produk_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen"))
            ->union(DB::table('monografi_hukums')
                ->select(DB::raw("id as id"), DB::raw("nomor as nomor"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'monografi_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")))
            ->union(DB::table('artikel_hukums')
                ->select(DB::raw("id as id"), DB::raw("nomor as nomor"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'artikel_hukum' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")))
            ->union(DB::table('putusan_pengadilans')
                ->select(DB::raw("id as id"), DB::raw("nomor as nomor"), DB::raw("CAST(judul AS CHAR) as judul"), DB::raw("CAST(tanggal_pengundangan AS CHAR) as tanggal_pengundangan"), DB::raw("CAST(created_at AS CHAR) as created_at"), DB::raw("'' as abstrak"), DB::raw("CAST(jumlah_dilihat AS CHAR) as jumlah_dilihat"), DB::raw("CAST(jumlah_diunduh AS CHAR) as jumlah_diunduh"), DB::raw("'putusan_pengadilan' as tipe"), DB::raw("CAST(status_dokumen AS CHAR) as status_dokumen")));

        if ($keyword) {
            $hasilPencarian->where('judul', 'like', "%$keyword%");
        }

        if ($tahun) {
            $hasilPencarian->whereYear('tanggal_pengundangan', $tahun);
        }

        if ($cariNomor) {
            $hasilPencarian->where('nomor', $cariNomor);
        }

        if ($status) {
            $hasilPencarian->where('status_dokumen', $status);
        }

        $hasilPencarian = $hasilPencarian->orderBy('tanggal_pengundangan', $sort == 'oldest' ? 'asc' : 'desc')
            ->paginate(10);

        $noResults = $hasilPencarian->isEmpty();

        return view('JDIH.hasil-pencarian', ['hasilPencarian' => $hasilPencarian, 'noResults' => $noResults]);
    }
}
