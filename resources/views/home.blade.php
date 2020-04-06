@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-home">
                <div class="card-header bg-dark text-light border-light">Veja os próximos eventos</div>
                <div class="card-body bg-secondary text-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Adicionar próximos 5 eventos aqui
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-home">
                <div class="card-header bg-dark text-light border-light">Publicidades mais vistas</div>
                <div class="card-body bg-secondary text-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Adicionar publicidades aqui
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-home">
                <div class="card-header bg-dark text-light border-light">Últimos contatos</div>
                <div class="card-body bg-secondary text-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Adicionar últimos 10 contatos aqui
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
