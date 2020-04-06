@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-filter">
                    <div class="card-body bg-secondary text-white">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-2">
                                    <input type="text" name="when" id="when" class="form-control"  placeholder="Data do evento" value="{{ $filter['when'] }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome do evento" value="{{ $filter['name'] }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="artist" class="form-control" placeholder="Artista" value="{{ $filter['artist'] }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="location" class="form-control" placeholder="Localização" value="{{ $filter['location'] }}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-primary" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('events')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-2 clearfix">
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-event">Adicionar Evento</a>
                                    <div class="modal fade create-event" id="create-event">
                                        <form method="post" action="add-event">
                                            @csrf
                                            <div class="modal-dialog modal-lg">
                                                <div class="bg-dark modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><strong>Cadastre seu evento</strong></h5>
                                                        <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-center col-md-12 row">
                                                        <div class="col-md-6">
                                                            <input type="text" name="name" class="form-control form-event" placeholder="Nome" required>
                                                            <input type="text" name="location" class="form-control form-event" placeholder="Localização" required>
                                                            <input type="text" name="when" class="form-control form-event" placeholder="Data" required>
                                                            <div class="custom-file form-event">
                                                                <input type="file" class="custom-file-input form-event" id="pictures">
                                                                <label class="custom-file-label" for="pictures">Imagem principal</label>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input form-event" id="pictures">
                                                                <label class="custom-file-label" for="pictures">Imagens</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="name" class="form-control form-event" placeholder="Artista">
                                                            <input type="text" name="sale_link" class="form-control form-event" placeholder="Link">
                                                            <input type="text" name="end_at" class="form-control form-event" placeholder="Data do fim (não necessário)">
                                                            <div class="custom-control custom-checkbox mb-3 text-left" style="margin-top: 15px">
                                                                <input type="checkbox" class="custom-control-input" id="indicated-check" required>
                                                                <label class="custom-control-label" for="indicated-check"> Indicado pelo Safari</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3 text-left">
                                                                <input type="checkbox" class="custom-control-input" id="featured-check" required>
                                                                <label class="custom-control-label" for="featured-check"> Evento destacado</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <label>Descrição</label>
                                                        <textarea class="form-control" name="description" style="height: 100px;" id="description" aria-label="Descrição do evento" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button class="btn btn-primary">Salvar evento</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header bg-secondary text-light border-light"><strong style="font-size: 20px">Próximos eventos</strong></div>
                    <div class="card-body bg-dark text-white">
                        <div class="card text-light table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="bg-dark text-light text-uppercase">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Artista</th>
                                    <th scope="col">Localização</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="bg-dark text-light">
                                    @foreach($events as $event)
                                        <tr>
                                            <th scope="col">{{ $event->name }}</th>
                                            <th scope="col">{{ $event->when }}</th>
                                            <th scope="col">{{ $event->artist }}</th>
                                            <th scope="col">{{ $event->location }}</th>
                                            <th scope="col">{{ substr(0, 20, $event->description) }}</th>
                                            <th scope="col">{{ $event->sale_link }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $event->id }}"><i class="fas fa-pencil"></i></a>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $event->id }}"><i class="fas fa-trash"></i></a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
