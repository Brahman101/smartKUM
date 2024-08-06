@extends('JDIH.layout.app')
@section('title','Peraturan Perundang-Undangan - JDIH Kota Batu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/JDIH/produkPeraturan.css') }}">
@endsection

@section('content')
<section class="main-section d-flex flex-column align-items-center justify-content-center">
    <h2>Peraturan Perundang-Undangan</h2>
    <div class="container d-flex flex-row align-items-start">
        <!-- Left Part -->
        <div class="left-part d-flex flex-column align-items-center justify-content-center">
            <a href="{{route('detail-produkPerundangan')}}" class="custom-card d-flex flex-column align-items-center justify-content-start">
                <div class="card-content d-flex flex-column align-items-center justify-content-start">
                    <h3>[peraturan_perundangan_title]</h3>
                    <div class="rule-details d-flex flex-row justify-content-between align-items-center">
                        <div class="rule-details-component d-flex flex-row align-items-center justify-content-start">
                            <p>[tanggal_diterbitkan]</p>
                            <p>[jenis_produk_hukum]</p>
                        </div>
                        <div class="rule-details-component d-flex flex-row align-items-center justify-content-end">
                            <p><i class="fa-regular fa-eye"></i>[seen]</p>
                            <p><i class="fa-solid fa-download"></i>[download]</p>
                        </div>
                    </div>
                    <h5>Lorem ipsum odor amet, consectetuer adipiscing elit. Ad mollis varius sem curabitur torquent nisl molestie. Vulputate facilisi id risus tempus nam litora habitasse erat. Congue nullam magnis quisque convallis primis habitasse natoque. Augue nulla metus phasellus at potenti lorem interdum nam.</h5>
                </div>
            </a>

            <!-- Pagination Here -->
        </div>
        <!-- End Left Part -->

        <!-- Right Part -->
        <div class="right-part d-flex flex-column align-items-center justify-content-center">
            <div class="search-box d-flex flex-column align-items-center justify-content-start">
                <div class="form-group judul d-flex flex-column align-items-center justify-content-start">
                    <label for="cari-judul-kotak">Judul</label>
                    <input type="text" class="form-control" id="cari-judul-kotak" placeholder="Judul Produk Hukum...">
                </div>
                <div class="dropdown">
                    <label for="dropdownTipe">Tipe Dokumen</label>
                    <button id="dropdownTipe" class="dropdown-toggle custom-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        - Pilih Tipe Dokumen -
                    </button>
                    <ul class="dropdown-menu drop-tipe-dokumen">
                        <li><a class="dropdown-item item-tipe-dokumen" href="#" data-value="Semua-Tipe">Semua</a></li>
                        <li><a class="dropdown-item item-tipe-dokumen" href="#" data-value="Peraturan Perundang-Undangan">Peraturan Perundag-Undangan</a></li>
                        <li><a class="dropdown-item item-tipe-dokumen" href="#" data-value="Monografi Hukum">Monografi Hukum</a></li>
                        <li><a class="dropdown-item item-tipe-dokumen" href="#" data-value="Artikel Hukum">Artikel Hukum</a></li>
                        <li><a class="dropdown-item item-tipe-dokumen" href="#" data-value="Putusan Pengadilan">Putusan Pengadilan</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <label for="dropdownJenis">Jenis Dokumen</label>
                    <button id="dropdownJenis" class="dropdown-toggle custom-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        - Pilih Tipe Dokumen -
                    </button>
                    <ul class="dropdown-menu drop-jenis-dokumen">
                        <li><a class="dropdown-item item-jenis-dokumen" href="#" data-value="Semua-Jenis">Semua</a></li>
                        <li><a class="dropdown-item item-jenis-dokumen" href="#" data-value="Keputusan Wali Kota">Keputusan Wali Kota</a></li>
                        <li><a class="dropdown-item item-jenis-dokumen" href="#" data-value="Peraturan Daerah">Peraturan Daerah</a></li>
                        <li><a class="dropdown-item item-jenis-dokumen" href="#" data-value="Peraturan Walikota">Peraturan Walikota</a></li>
                    </ul>
                </div>
                <div class="form-group judul d-flex flex-column align-items-center justify-content-start">
                    <label for="cari-tahun-kotak">Tahun</label>
                    <input type="text" class="form-control" id="cari-tahun-kotak" placeholder="Tahun...">
                </div>
                <div class="form-group judul d-flex flex-column align-items-center justify-content-start">
                    <label for="cari-nomor-kotak">Nomor</label>
                    <input type="text" class="form-control" id="cari-nomor-kotak" placeholder="Nomor...">
                </div>
                <div class="dropdown">
                    <label for="dropdownStatus">Status</label>
                    <button id="dropdownStatus" class="dropdown-toggle custom-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        - Status -
                    </button>
                    <ul class="dropdown-menu drop-status">
                        <li><a class="dropdown-item item-status" href="#" data-value="Semua-Status">Semua</a></li>
                        <li><a class="dropdown-item item-status" href="#" data-value="Berlaku">Berlaku</a></li>
                        <li><a class="dropdown-item item-status" href="#" data-value="Tidak Berlaku">Tidak Berlaku</a></li>
                    </ul>
                </div>
                <div class="text-center mt-4 btn-cari">
                    <button type="submit" class="btn custom-btn-cari">Cari</button>
                </div>
            </div>
            <div class="righ-part-link-portal d-flex flex-column align-items-center justify-content-center">
                <h4>Link Portal</h4>
                <div class="container d-flex flex-column align-items-center justify-content-around">
                    <a href="#" class="custom-card-link-portal align-items-center justify-content-around">
                        <div class="card-content">
                            <img src="{{asset('images/LogoJDIH.png')}}" alt="JDIH Nasional">
                            <h3>JDIH Nasional</h3>
                        </div>
                    </a>
                    <a href="#" class="custom-card-link-portal align-items-center justify-content-around">
                        <div class="card-content">
                            <img src="{{asset('images/LogoKotaBatu.png')}}" alt="PPID Kota Batu">
                            <h3>PPID Kota Batu</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
