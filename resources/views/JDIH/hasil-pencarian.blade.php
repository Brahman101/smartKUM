@extends('JDIH.layout.appdokumen')
@section('title', 'Hasil Pencarian - JDIH Kota Batu')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/JDIH/produkhukum.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <div class="main">
            <div class="container">
                <h2>Hasil Pencarian</h2>
                @include('JDIH.components.sort-options')
                @if ($noResults)
                    <p style="font-size: 18px; color: #333; text-align: center; margin-top: 20px;">Tidak ada hasil pencarian
                        yang sesuai.</p>
                @else
                    @foreach ($hasilPencarian as $item)
                        @php
                            $abstrak_singkat = str_word_count($item->abstrak, 2);
                            $abstrak_singkat = implode(' ', array_slice($abstrak_singkat, 0, 40)) . '...';
                        @endphp
                        <a href="/dashboard/readprodukhukum/{{ $item->id }}" class="custom-card new-rules-card">
                            <div class="card-content d-flex flex-row justify-content-between">
                                <div class="information d-flex flex-column align-items-start justify-content-start">
                                    <h5>{{ $item->judul }}</h5>
                                    <p class="p-new-rules">{{ $abstrak_singkat }}</p>
                                    <div class="status-dokumen">
                                        <span class="status-label">Status:</span>
                                        <span class="status-value {{ strtolower($item->status_dokumen) }}">
                                            {{ $item->status_dokumen }}
                                        </span>
                                    </div>
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
                @endif
                {{ $hasilPencarian->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/beranda.js') }}"></script>
@endsection
