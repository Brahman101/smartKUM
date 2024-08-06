@extends('JDIH.layout.app')
@section('title','Profil - JDIH Kota Batu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/JDIH/sop.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="box-header">
        <h2>SOP JDIH Kota Batu</h2>
        <div class="img-law">
            <img src="{{ asset('/img/bg/law.png') }}" alt="sop">
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/newhome.js') }}"></script>
@endsection