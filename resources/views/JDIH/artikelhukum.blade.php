@extends('JDIH.layout.appdokumen')
@section('title', 'Produk Hukum - JDIH Kota Batu')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/JDIH/produkhukum.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <div class="main">
            <div class="container">
                <h2>Produk Hukum</h2>
                @foreach ($produkHukum as $item)
                    @php
                        $abstrak_words = str_word_count($item->abstrak, 2);
                        $abstrak_singkat = implode(' ', array_slice($abstrak_words, 0, 40)) . '...';
                    @endphp
                    <a href="#" class="custom-card new-rules-card align-items-center justify-content-center">
                        <div class="card-content d-flex flex-row align-items-center justify-content-between">
                            <div class="information d-flex flex-column align-items-start justify-content-start">
                                <h5>{{ $item->judul }}</h5>
                                <p class="p-new-rules">{{ $abstrak_singkat }}</p>
                            </div>
                            <div class="new-rules-details">
                                <p class="p-new-rules">{{ $item->tanggal_pengundangan }}</p>
                                <div class="seen-counter">
                                    <i class="fas fa-eye"></i>
                                    <p class="p-new-rules">{{ $item->jumlah_dilihat }}</p>
                                </div>
                                <div class="download-counter">
                                    <i class="fas fa-download"></i>
                                    <p class="p-new-rules">{{ $item->jumlah_diunduh }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                {{ $produkHukum->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/beranda.js') }}"></script>
@endsection
