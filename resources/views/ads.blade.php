@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-filter card">
                    <div class="card-body">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-2 date">
                                    <input type="text" name="start_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="start_at" class="form-control datepicker"  placeholder="Início" value="{{ $filter['start_at'] }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 date">
                                    <input type="text" name="end_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="end_at" class="form-control datepicker"  placeholder="Fim" value="{{ $filter['end_at'] }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome da publicidade" value="{{ $filter['name'] }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="link" class="form-control" placeholder="Link" value="{{ $filter['link'] }}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-primary" type="submit" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('ads')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade create-publicity" id="create-publicity">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><strong>Cadastre sua publcidade</strong></h5>
                            <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="POST" action="{{ route('add-ad') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-center col-md-12 row">
                                <div class="form-group col-md-6 date">
                                    <input type="text" name="name" class="form-control form-event" placeholder="Nome" required>
                                    <input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="start_at" id="start_at" class="form-control form-event datepicker" placeholder="Data de inicio" required>
                                    <div class="custom-file form-event">
                                        <input type="file" name="publicity" class="custom-file-input form-event" id="publicity">
                                        <label class="custom-file-label text-left" for="publicity">Publicidade</label>
                                    </div>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 date">
                                    <input type="text" name="link" class="form-control form-event" placeholder="Link" required>
                                    <input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="end_at" class="form-control form-event datepicker" placeholder="Data do fim">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button class="btn btn-primary" type="submit">Salvar publicidade</button>
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
                        <strong style="font-size: 20px">Últimas publicidades</strong>
                        <div class="col-md-2 col-sm-2 clearfix float-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-publicity">Criar Publicidade</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data de início</th>
                                    <th scope="col">Data de fim</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($ads as $ad)
                                        <tr>
                                            <th scope="col">{{ $ad->name }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ad->start_at)->format('d/m/Y') }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ad->end_at)->format('d/m/Y') }}</th>
                                            <th scope="col">{{ $ad->link }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $ad->id }}"><i class="fa fa-pen"></i></a>
                                                <div class="modal fade edit-{{ $ad->id }}" id="edit-{{ $ad->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Ediar publicidade</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('edit-ad') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body text-center col-md-12 row">
                                                                    <div class="form-group col-md-6 date">
                                                                        <input type="hidden" name="id" class="form-control form-event" placeholder="id" value="{{ $ad->id }}" required>
                                                                        <input type="text" name="name" class="form-control form-event" placeholder="Nome" value="{{ $ad->name }}" required>
                                                                        <input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="start_at" id="start_at" class="form-control form-event datepicker" placeholder="Data de inicio" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ad->start_at)->format('d/m/Y') }}" required>
                                                                        <div class="custom-file form-event">
                                                                            <input type="file" name="publicity" class="custom-file-input form-event" id="publicity">
                                                                            <label class="custom-file-label text-left" for="publicity">{{ is_null($ad->picture) ? 'Publicidade não adicionada' :  $ad->picture->title}}</label>
                                                                        </div>
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6 date">
                                                                        <input type="text" name="link" class="form-control form-event" placeholder="Link" value="{{ $ad->link }}" required>
                                                                        <input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="end_at" class="form-control form-event datepicker" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ad->end_at)->format('d/m/Y') }}"  placeholder="Data do fim">
                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(!is_null($ad->picture))
                                                                <div class="modal-body text-left">
                                                                    <label><strong>Publicidade</strong></label>
                                                                    <div>
                                                                        <a class="btn btn-danger trash-image position-absolute" title="Excluir imagem" href="{{ route('del-img', ['id' => $ad->picture->id, 'redirect' => 'publicidades']) }}"><i class="fa fa-trash"></i></a>
                                                                        <img class="imageable" src="data:image/png;base64, {{ $ad->picture->image }}" id="image" title="{{ $ad->picture->title }}" aria-label="Imagem da publicidade" alt="">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                                    <button class="btn btn-primary" type="submit">Editar publicidade</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $ad->id }}"><i class="fa fa-trash text-danger"></i></a>
                                                <div class="modal fade delete-{{ $ad->id }}" id="delete-{{ $ad->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Você deseja realmente excluir essa publicidade?</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="post" action="{{ route("del-ad") }}">
                                                                @csrf
                                                                <input hidden name="id" type="text" value="{{$ad->id}}">
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
                            @if($ads->total() > 0)
                                <div class="card align-self-center {{ $ads->total() > $ads->perPage() ? 'paginator' : ''}} ">
                                    {!! $ads->render()!!}
                                </div>
                            @else
                                <div class="card align-self-center paginator">
                                    <h5>Não há publicidades</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
