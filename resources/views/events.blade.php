@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-filter card-home">
                    <div class="card-body">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-2 date">
                                    <input type="text" name="when" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="when" class="form-control datepicker" placeholder="Data do evento" value="{{ $filter['when'] }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome do evento" value="{{ $filter['name'] }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="artist" class="form-control" placeholder="Artista" value="{{ $filter['artist'] }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="location" class="form-control" placeholder="Localização" value="{{ $filter['location'] }}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-primary" type="submit" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('events')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade create-event" id="create-event">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><strong>Cadastre seu evento</strong></h5>
                            <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="POST" action="{{ route('add-event') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-center col-md-12 row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control form-event" placeholder="Nome" required>
                                    <input type="text" name="location" class="form-control form-event" placeholder="Localização" required>
                                    <div class="date">
                                        <input type="text" name="when" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="when" class="form-control form-event datepicker" placeholder="Data do evento" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file form-event">
                                        <input type="file" name="main_picture" class="custom-file-input form-event" id="main_picture">
                                        <label class="custom-file-label text-left" for="main_picture">Imagem principal</label>
                                    </div>
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
                                    <input type="text" name="artist" class="form-control form-event" placeholder="Artista">
                                    <input type="text" name="sale_link" class="form-control form-event" placeholder="Link">
                                    <input type="text" name="hour" class="form-control form-event" placeholder="Horário" required>
                                    <div class="date">
                                        <input type="text" name="end_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="when" class="form-control form-event datepicker" placeholder="Data do fim (não necessário)">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row" style="right: -10px">
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
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button class="btn btn-primary" type="submit">Salvar evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header">
                        <strong style="font-size: 20px">Próximos eventos</strong>
                        <div class="col-md-2 col-sm-2 clearfix float-right">
                            <a href="{{ url('editar-evento?id=*') }}" class="btn btn-success">Adicionar Evento</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="text-uppercase">
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
                                <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <th scope="col">{{ $event->name }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->when)->format('d/m/Y H:i') }}</th>
                                            <th scope="col">{{ $event->artist ?? 'Sem artista' }}</th>
                                            <th scope="col">{{ $event->location }}</th>
                                            <th scope="col">{{ $event->description }}</th>
                                            <th scope="col">{{ $event->sale_link }}</th>
                                            <th scope="col">
                                                <a href="{{ url('editar-evento?id='.$event->id) }}" title="Visualizar"><i class="fa fa-eye"></i></a>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $event->id }}"><i class="fa fa-trash text-danger"></i></a>
                                                <div class="modal fade delete-{{ $event->id }}" id="delete-{{ $event->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Você deseja realmente excluir esse evento?</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="post" action="{{ route("del-event") }}">
                                                                @csrf
                                                                <input hidden name="id" type="text" value="{{$event->id}}">
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-danger" type="submit">Deletar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($events->total() > 0)
                                <div class="card align-self-center {{ $events->total() > $events->perPage() ? 'paginator' : ''}} ">
                                    {!! $events->render()!!}
                                </div>
                            @else
                                <div class="card align-self-center paginator">
                                    <h5>Não há eventos</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
