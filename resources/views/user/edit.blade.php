@extends('layouts.app')

@section('content-header')
    @component('layouts.inc.content-header')
        @slot('title')
            Perfil
        @endslot

        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a href="#">Perfil</a></li>
            <li class="breadcrumb-item active">Editar</li>
        @endslot
    @endcomponent
@endsection

@section('content')
<profile></profile>
@endsection
