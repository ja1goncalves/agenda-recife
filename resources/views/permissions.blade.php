@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-filter">
                    <div class="card-body bg-secondary text-white">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-6">
                                    <input type="text" name="route" id="route" class="form-control"  placeholder="Rota" value="{{ $filter['route'] }}">
                                </div>
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-primary" type="submit" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('permissions')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-2 clearfix">
                                    <a href="{{ route('update-routes') }}" class="btn btn-success">Atualizar rotas</a>
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
                    <div class="card-header bg-secondary text-light border-light"><strong style="font-size: 20px">Rotas do Sistema</strong></div>
                    <div class="card-body bg-dark text-white">
                        <div class="card text-light table-responsive">
                            <table class="table table-striped text-center">
                                <thead class="bg-secondary text-light text-uppercase">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rota</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Criado</th>
                                </tr>
                                </thead>
                                <tbody class="bg-dark text-light">
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <th scope="col">{{ $permission->id }}</th>
                                            <th scope="col">{{ $permission->route }}</th>
                                            <th scope="col">
                                                <a class="btn btn-{{$permission->inactive ? 'danger' : 'success'}}" href="{{ url('inativar-rota?id='.$permission->id) }}"
                                                     title="{{ $permission->inactive ? 'Clique para reativar': 'Clique para bloquear' }}" style="padding: 0% 3%;">
                                                    <i class="fa fa-{{$permission->inactive ? 'close' : 'check'}}"></i>
                                                </a>
                                            </th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $permission->created_at)->format('d/m/Y H:i') }}</th>
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