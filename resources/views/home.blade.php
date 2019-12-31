@extends('layouts.app')

@section('content-header')
    @component('layouts.inc.content-header')
        @slot('title')
            Home
        @endslot

        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let auth = @json(auth()->user()->only('id', 'name', 'email'));
        console.log(auth.id);
        if (typeof(Storage) !== "undefined") {
            if(localStorage.getItem('user')){
                let user = JSON.parse(localStorage.getItem('user'));
                if(user.id !== auth.id){
                    localStorage.setItem("user", JSON.stringify(auth));
                }
            } else {
                localStorage.setItem("user", JSON.stringify(auth));
            }
        } else {
            alert('Sem suporte para as funcionalidades da aplicação')
        }
    </script>
@endpush
