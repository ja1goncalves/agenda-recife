@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-filter">
                    <div class="card-body bg-secondary text-white">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-4">
                                    <input type="text" name="email" id="email" class="form-control"  placeholder="E-mail" value="{{ $filter['email'] }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{ $filter['name'] }}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-primary" type="submit" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('users')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-2 clearfix">
                                    <a href="{{ route('register') }}" class="btn btn-success">Adicionar Usuário</a>
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
                    <div class="card-header bg-secondary text-light border-light"><strong style="font-size: 20px">Usuários registrados</strong></div>
                    <div class="card-body bg-dark text-white">
                        <div class="card text-light table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="bg-dark text-light text-uppercase">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Criado</th>
                                    <th scope="col">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="bg-dark text-light">
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="col">{{ $user->id }}</th>
                                            <th scope="col">{{ $user->name }}</th>
                                            <th scope="col">{{ $user->email }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y H:i') }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $user->id }}"><i class="fa fa-pencil"></i></a>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $user->id }}"><i class="fa fa-trash text-danger"></i></a>
                                                <a href="#" title="Permissões" data-toggle="modal" data-target="#permissions-{{ $user->id }}"><i class="fa fa-unlock text-white"></i></a>
                                                <div class="modal fade permissions-{{ $user->id }}" id="permissions-{{ $user->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="bg-dark text-white modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><strong>Permissoões do usuário</strong></h5>
                                                                <button type="button" class="close text-danger" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('user-permission') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body text-center col-md-12 row">
                                                                    @foreach($user->userPermissions as $permission)
                                                                    <div class="form-group col-md-4">
                                                                        <div class="custom-control custom-checkbox text-left">
                                                                            <input type="checkbox" name="permission-{{$permission->id}}" {{$permission->permission->inactive ? 'disabled' : ''}} class="custom-control-input" id="permission-check-{{$permission->id}}" {{$permission->auth ? 'checked' : ''}}>
                                                                            <label class="custom-control-label" for="permission-check-{{$permission->id}}"> {{$permission->permission->route}}</label>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                                    <button class="btn btn-primary" type="submit">Salvar permissões</button>
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
