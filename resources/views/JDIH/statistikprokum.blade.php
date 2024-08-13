@extends('JDIH.layout.app')
@section('title','Statistik - JDIH Kota Batu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/JDIH/statistik.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="box-header">
        <h2>Grafik Tahunan Produk Hukum</h2>
        <div class="img-statistik">
            <img src="{{ asset('/img/bg/statistik_prokum.png') }}" alt="statistikprokum" class="img-fluid">
        </div>
        <h2>Grafik Tahunan Status Peraturan Perundang-undangan</h2>
        <div class="img-statistik">
            <img src="{{ asset('/img/bg/statistik_prokum.png') }}" alt="statistikprokum" class="img-fluid">
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/beranda.js') }}"></script>
@endsection