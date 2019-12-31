@extends('layouts.app')

@section('content-header')
    @component('layouts.inc.content-header')
        @slot('title')
            Transações
        @endslot

        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a href="#">Transações</a></li>
{{--            <li class="breadcrumb-item active"></li>--}}
        @endslot
    @endcomponent
@endsection

@section('content')
    <transaction></transaction>
@endsection
