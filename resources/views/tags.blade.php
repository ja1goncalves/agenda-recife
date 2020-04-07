@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header bg-secondary text-light border-light">
                        <strong style="font-size: 20px">Tags de eventos</strong>

                        <div class="float-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-tag">Adicionar tag</a>
                        </div>
                        <div class="modal fade create-tag" id="create-tag">
                            <div class="modal-dialog modal-lg">
                                <div class="bg-dark text-white modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Cadastre uma nova tag de evento</strong></h5>
                                        <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <form method="POST" action="{{ route('add-tag') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-center col-md-12">
                                            <input type="text" id="name" name="name" class="form-control form-event" placeholder="Nome" required>
                                            <label for="name"></label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                            <button class="btn btn-primary" type="submit">Salvar tag</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-dark text-white">
                        <div class="card text-light table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="bg-secondary text-light text-uppercase">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Criado</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody class="bg-dark text-light">
                                    @foreach($tags as $tag)
                                        <tr>
                                            <th scope="col">{{ $tag->id }}</th>
                                            <th scope="col">{{ $tag->name }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tag->created_at)->format('d/m/Y H:i') }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $tag->id }}"><i class="fa fa-pencil"></i></a>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $tag->id }}"><i class="fa fa-trash text-danger"></i></a>
                                                <div class="modal fade delete-{{ $tag->id }}" id="delete-{{ $tag->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="bg-dark text-white modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Você deseja realmente excluir essa tag?</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="post" action="{{ route("del-tag") }}">
                                                                @csrf
                                                                <input hidden name="id" type="text" value="{{$tag->id}}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
