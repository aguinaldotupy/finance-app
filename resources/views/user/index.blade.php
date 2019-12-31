@extends('layouts.app')

@section('content-header')
    @component('layouts.inc.content-header')
        @slot('title')
            index.blade.php
        @endslot

        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a href="#">index.blade.php</a></li>
            <li class="breadcrumb-item active">Lista</li>
        @endslot
    @endcomponent
@endsection

@section('content')

@endsection
