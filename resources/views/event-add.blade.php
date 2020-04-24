@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header"><strong style="font-size: 20px">Cadastre seu evento</strong></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add-event') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-left col-md-12 row">
                                <div class="form-group col-md-6">
                                    <label for="name"><strong>Nome</strong></label>
                                    <input type="text" name="name" id="name" class="form-control form-event" placeholder="Nome" required>
                                    <label for="location"><strong>Localização</strong></label>
                                    <input type="text" name="location" id="location" class="form-control form-event" placeholder="Localização" required>
                                    <label for="when"><strong>Data</strong></label>
                                    <div class="date">
                                        <input type="text" name="when" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="when" class="form-control form-event datepicker" placeholder="Data do evento" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <label for="main_picture"><strong>Imagem principal</strong></label>
                                    <div class="custom-file form-event">
                                        <input type="file" name="main_picture" class="custom-file-input form-event" id="main_picture">
                                        <label class="custom-file-label text-left" for="main_picture">Imagem principal</label>
                                    </div>
                                    <label for="pictures"><strong>Outras imagens</strong></label>
                                    <div class="custom-file form-event">
                                        <input type="file" name="pictures[]" class="custom-file-input form-event" id="pictures" multiple>
                                        <label class="custom-file-label text-left" for="pictures">Outras imagens</label>
                                    </div>
                                    <div class="text-left form-event" style="margin-top: 10px;">
                                        <label><strong>Categorias</strong></label>
                                        <div class="col-md-12 row">
                                            @foreach($categories as $category)
                                                <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                    <input type="checkbox" name="category[{{$category->id}}]" class="custom-control-input" id="category-{{$category->id}}">
                                                    <label class="custom-control-label" for="category-{{$category->id}}">{{ $category->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="artist"><strong>Artista</strong></label>
                                    <input type="text" name="artist" id="artist" class="form-control form-event" placeholder="Artista">
                                    <label for="sale_link"><strong>Link</strong></label>
                                    <input type="text" name="sale_link" id="sale_link" class="form-control form-event" placeholder="Link">
                                    <label for="hour"><strong>Horário</strong></label>
                                    <input type="time" name="hour" id="hour" class="form-control form-event" placeholder="Horário" required>
                                    <label for="end_at"><strong>Date de fim do evento</strong></label>
                                    <div class="date">
                                        <input type="text" name="end_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="end_at" class="form-control form-event datepicker" placeholder="Data do fim (não necessário)">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row" style="right: -10px; margin-top: 20px">
                                        <div class="custom-checkbox mb-3 text-left col-md-6" style="margin-top: 15px">
                                            <input type="checkbox" name="indicated" class="custom-control-input" id="indicated-check">
                                            <label class="custom-control-label" for="indicated-check"> Indicado pelo Safari</label>
                                        </div>
                                        <div class="custom-checkbox mb-3 text-left col-md-6" style="margin-top: 15px">
                                            <input type="checkbox" name="featured" class="custom-control-input" id="featured-check">
                                            <label class="custom-control-label" for="featured-check"> Evento destacado</label>
                                        </div>
                                    </div>
                                    <div class="text-left form-event">
                                        <label><strong>Tags</strong></label>
                                        <div class="col-md-12 row">
                                            @foreach($tags as $tag)
                                                <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                    <input type="checkbox" name="tag[{{$tag->id}}]" class="custom-control-input" id="tag-{{$tag->id}}">
                                                    <label class="custom-control-label" for="tag-{{$tag->id}}">{{ $tag->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group modal-body text-left">
                                <label><strong>Descrição</strong></label>
                                <textarea class="form-control" name="description" style="height: 100px;" id="description" aria-label="Descrição do evento" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="{{ route('events') }}">Voltar</a>
                                <button class="btn btn-primary" type="submit">Criar evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
