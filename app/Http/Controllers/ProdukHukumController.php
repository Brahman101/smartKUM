<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use App\Models\ArtikelHukum;
use App\Models\MonografiHukum;
use App\Models\PutusanPengadilan;

class ProdukHukumController extends Controller
{
    protected $produkHukum;
    protected $artikelHukum;
    protected $monografiHukum;
    protected $putusanPengadilan;

    public function __construct(ProdukHukum $produkHukum, ArtikelHukum $artikelHukum, MonografiHukum $monografiHukum, PutusanPengadilan $putusanPengadilan)
    {
        $this->produkHukum = $produkHukum;
        $this->artikelHukum = $artikelHukum;
        $this->monografiHukum = $monografiHukum;
        $this->putusanPengadilan = $putusanPengadilan;
    }

    public function cari(Request $request)
    {
        $request->validate([
            'cariKeyword' => 'nullable|string|max:255',
            'tipeDokumen' => 'nullable|string|in:Peraturan Perundang-Undangan,Artikel Hukum,Monografi Hukum,Putusan Pengadilan',
            'jenisDokumen' => 'nullable|string|in:Peraturan Daerah,Keputusan Walikota,Peraturan Walikota',
            'cariTahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'cariNomor' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
        ]);

        $keyword = $request->input('cariKeyword');
        $tipeDokumen = $request->input('tipeDokumen');
        $jenisDokumen = $request->input('jenisDokumen');
        $tahun = $request->input('cariTahun');
        $nomor = $request->input('cariNomor');
        $status = $request->input('status');

        $produkHukum = $this->produkHukum->newQuery();
        $artikelHukum = $this->artikelHukum->newQuery();
        $monografiHukum = $this->monografiHukum->newQuery();
        $putusanPengadilan = $this->putusanPengadilan->newQuery();

        $this->applyKeywordFilter($keyword, $produkHukum, $artikelHukum, $monografiHukum, $putusanPengadilan);
        $this->applyTipeDokumenFilter($tipeDokumen, $produkHukum, $artikelHukum, $monografiHukum, $putusanPengadilan);
        $this->applyJenisDokumenFilter($jenisDokumen, $produkHukum);
        $this->applyTahunFilter($tahun, $produkHukum, $artikelHukum, $monografiHukum, $putusanPengadilan);
        $this->applyNomorFilter($nomor, $produkHukum);
        $this->applyStatusFilter($status, $produkHukum);

        $hasilPencarian = $produkHukum->paginate(15);
        $mergedCollection = $hasilPencarian->getCollection()
            ->merge($artikelHukum->get())
            ->merge($monografiHukum->get())
            ->merge($putusanPengadilan->get())
            ->map(function ($item) {
                return $this->formatHasilPencarian($item);
            });

        $hasilPencarian->setCollection($mergedCollection);

        return view('JDIH.hasil-pencarian', compact('hasilPencarian'));
    }

    private function formatHasilPencarian($item)
    {
        return [
            'judul' => $item->judul,
            'abstrak' => $item->abstrak,
            'tanggal_pengundangan' => $item->tanggal_pengundangan,
            'jumlah_dilihat' => $item->jumlah_dilihat,
            'jumlah_diunduh' => $item->jumlah_diunduh
        ];
    }

    private function applyKeywordFilter($keyword, ...$queries)
    {
        if ($keyword) {
            foreach ($queries as $query) {
                $query->where('judul', 'like', '%' . $keyword . '%');
            }
        }
    }

    private function applyTipeDokumenFilter($tipeDokumen, $produkHukum, $artikelHukum, $monografiHukum, $putusanPengadilan)
    {
        if ($tipeDokumen) {
            $queryMap = [
                'Peraturan Perundang-Undangan' => $produkHukum,
                'Artikel Hukum' => $artikelHukum,
                'Monografi Hukum' => $monografiHukum,
                'Putusan Pengadilan' => $putusanPengadilan
            ];

            if (isset($queryMap[$tipeDokumen])) {
                $queryMap[$tipeDokumen]->where('tipe_dokumen', $tipeDokumen);
            }
        }
    }

    private function applyJenisDokumenFilter($jenisDokumen, $produkHukum)
    {
        if ($jenisDokumen) {
            $produkHukum->where('jenis_dokumen', $jenisDokumen);
        }
    }

    private function applyTahunFilter($tahun, ...$queries)
    {
        if ($tahun) {
            foreach ($queries as $query) {
                $query->whereYear('tanggal_pengundangan', $tahun);
            }
        }
    }

    private function applyNomorFilter($nomor, $produkHukum)
    {
        if ($nomor) {
            $produkHukum->where('nomor', $nomor);
        }
    }

    private function applyStatusFilter($status, $produkHukum)
    {
        if ($status) {
            $produkHukum->where('status_dokumen', $status);
        }
    }
}
