@extends('layouts.app')

@section('content-header')
    @component('layouts.inc.content-header')
        @slot('title')
            Calendário
        @endslot

        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a href="#">Calendário</a></li>
            <li class="breadcrumb-item active">Movimentações</li>
        @endslot
    @endcomponent
@endsection

@section('content')
<calendar></calendar>
@endsection
