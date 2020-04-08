@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-filter">
                    <div class="card-body bg-secondary text-white">
                        <form method="get">
                            <div class="row col-sm-12">
                                <div class="col-sm-3 date">
                                    <input type="text" name="created_at" data-provide="datepicker" data-date-format="dd/mm/yyyy" id="date" class="form-control datepicker" placeholder="Data" value="{{ $filter['created_at'] }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="subject" id="date" class="form-control"  placeholder="Assunto" value="{{ $filter['subject'] }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ $filter['email'] }}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-primary" type="submit" title="Filtrar">
                                        <i class="fa fa-search" id="i-search"></i>
                                    </button>
                                    <a class="btn btn-danger" title="Limpar filtro" href="{{ route('reports')}}">
                                        <i class="fa fa-close" id="i-clear"></i>
                                    </a>
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
                    <div class="card-header bg-secondary text-light border-light"><strong style="font-size: 20px">Últimos contatos</strong></div>
                    <div class="card-body bg-dark text-white">
                        <div class="card text-light table-responsive bg-secondary">
                            <table class="table table-striped text-center">
                                <thead class="bg-secondary text-light text-uppercase">
                                <tr>
                                    <th scope="col">Assunto</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Motivação</th>
                                    <th scope="col">Texto</th>
                                    <th scope="col">Criação</th>
                                    <th scope="col">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="bg-dark text-light">
                                    @foreach($reports as $report)
                                        <tr>
                                            <th scope="col">{{ substr(0, 20, $report->subject) }}</th>
                                            <th scope="col">{{ $report->email }}</th>
                                            <th scope="col">{{ substr(0, 20, $report->motivation) }}</th>
                                            <th scope="col">{{ substr(0, 20, $report->body) }}</th>
                                            <th scope="col">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ad->created_at)->format('d/m/Y') }}</th>
                                            <th scope="col">
                                                <a href="#" title="Editar" data-toggle="modal" data-target="#edit-{{ $report->id }}"><i class="fa fa-pencil"></i></a>
                                                <a href="#" title="Remover" data-toggle="modal" data-target="#delete-{{ $report->id }}"><i class="fa fa-trash text-danger"></i></a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($reports->total() > 0)
                            <div class="card align-self-center {{ $reports->total() > $reports->perPage() ? 'bg-dark border-dark paginator' : ''}} ">
                                {!! $reports->render()!!}
                            </div>
                            @else
                            <div class="card align-self-center bg-dark border-dark paginator">
                                <h5>Não há contatos</h5>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
