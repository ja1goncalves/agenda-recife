@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header">
                        <strong style="font-size: 20px">Categorias de eventos</strong>
                        <div class="float-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-category">Adicionar categoria</a>
                        </div>
                        <div class="modal fade create-category" id="create-category">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Cadastre uma nova categoria de evento</strong></h5>
                                        <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <form method="POST" action="{{ route('add-category') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-center col-md-12">
                                            <input type="text" id="name" name="name" class="form-control form-event" placeholder="Nome" required>
                                            <label for="name"></label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                            <button class="btn btn-primary" type="submit">Salvar categoria</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Criado</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="col">{{ $category->id }}</th>
                                            <th scope="col">{{ $category->name }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('d/m/Y H:i') }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $category->id }}"><i class="fa fa-pen"></i></a>
                                                <div class="modal fade edit-{{ $category->id }}" id="edit-{{ $category->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Editar Categoria</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('edit-category') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body text-center col-md-12">
                                                                    <input type="hidden" id="id" name="id" class="form-control form-event" value="{{ $category->id }}" required>
                                                                    <input type="text" id="name" name="name" class="form-control form-event" value="{{ $category->name }}" required>
                                                                    <label for="name"></label>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                                    <button class="btn btn-primary" type="submit">Editar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $category->id }}"><i class="fa fa-trash text-danger"></i></a>
                                                <div class="modal fade delete-{{ $category->id }}" id="delete-{{ $category->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Você deseja realmente excluir essa categoria?</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="post" action="{{ route("del-category") }}">
                                                                @csrf
                                                                <input hidden name="id" type="text" value="{{$category->id}}">
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
                            @if($categories->total() > 0)
                                <div class="card align-self-center {{ $categories->total() > $categories->perPage() ? 'paginator' : ''}} ">
                                    {!! $categories->render()!!}
                                </div>
                            @else
                                <div class="card align-self-center paginator">
                                    <h5>Não há categorias</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
