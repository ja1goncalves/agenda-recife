@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-home">
                    <div class="card-header bg-secondary text-light border-light"><strong style="font-size: 20px">{{ $event->name }}</strong></div>
                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('update-event') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-center col-md-12 row">
                                <div class="form-group col-md-6 text-left">
                                    <input type="hidden" name="id" id="id" class="form-control form-event" value="{{ $event->id }}" placeholder="Nome" required>
                                    <label for="name"><strong>Nome</strong></label>
                                    <input type="text" name="name" id="name" class="form-control form-event" value="{{ $event->name }}" placeholder="Nome" required>
                                    <label for="name"><strong>Localização</strong></label>
                                    <input type="text" name="location" class="form-control form-event" value="{{ $event->location }}" placeholder="Localização" required>
                                    <label for="name"><strong>Data</strong></label>
                                    <input type="text" name="when" class="form-control form-event" value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->when)->format('d/m/Y') }}" placeholder="Data" required>
                                    <label for="name"><strong>Imagem principal</strong></label>
                                    <div class="custom-file form-event">
                                        <input type="file" name="main_picture" class="custom-file-input form-event" id="main_picture">
                                        <label class="custom-file-label text-left" for="main_picture">{{ !is_null($event->mainPicture) ? $event->mainPicture->title : 'Adicione uma imagem principal' }}</label>
                                    </div>
                                    <label for="name"><strong>Outras imagens</strong></label>
                                    <div class="custom-file form-event">
                                        <input type="file" name="pictures[]" class="custom-file-input form-event" id="pictures" multiple>
                                        <label class="custom-file-label text-left" for="pictures">{{ count($event->pictures) == 0 ? 'Adicione outras imagens' : (!is_null($event->mainPicture) ? (count($event->pictures) - 1)." imagens" : count($event->pictures)." imagens") }}</label>
                                    </div>
                                    <div class="text-left form-event" style="margin-top: 10px;">
                                        <label><strong>Categorias</strong></label>
                                        <?php $print = false ?>
                                        <div class="col-md-12 row">
                                            @foreach($categories as $category)
                                                @foreach($event->eventCategory as $eCategory)
                                                    @if($category->id == $eCategory->category_id)
                                                        <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                            <input type="checkbox" name="category[{{$category->id}}]" class="custom-control-input" id="category-{{$category->id}}" checked>
                                                            <label class="custom-control-label" for="category-{{$category->id}}">{{ $category->name }}</label>
                                                        </div>
                                                        <?php $print = true; ?>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($print == false)
                                                    <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                        <input type="checkbox" name="category[{{$category->id}}]" class="custom-control-input" id="category-{{$category->id}}">
                                                        <label class="custom-control-label" for="category-{{$category->id}}">{{ $category->name }}</label>
                                                    </div>
                                                @endif
                                                <?php $print = false ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 text-left">
                                    <label for="name"><strong>Artista</strong></label>
                                    <input type="text" name="artist" class="form-control form-event" value="{{ $event->artist }}" placeholder="Artista">
                                    <label for="name"><strong>Link</strong></label>
                                    <input type="text" name="sale_link" class="form-control form-event" value="{{ $event->sale_link }}" placeholder="Link">
                                    <label for="name"><strong>Horário</strong></label>
                                    <input type="time" name="hour" class="form-control form-event" value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->when)->format('H:i') }}" placeholder="Horário" required>
                                    <label for="name"><strong>Date de fim do evento</strong></label>
                                    <input type="text" name="end_at" class="form-control form-event" placeholder="Data do fim (não necessário)">
                                    <div class="col-md-12 row" style="right: -10px; margin-top: 25px">
                                        <div class="custom-checkbox mb-3 text-left col-md-6" style="margin-top: 15px">
                                            <input type="checkbox" name="indicated" class="custom-control-input" id="indicated-check" {{$event->indicated ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="indicated-check"> Indicado pelo Safari</label>
                                        </div>
                                        <div class="custom-checkbox mb-3 text-left col-md-6" style="margin-top: 15px">
                                            <input type="checkbox" name="featured" class="custom-control-input" id="featured-check" {{$event->featured ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="featured-check"> Evento destacado</label>
                                        </div>
                                    </div>
                                    <div class="text-left form-event" style="margin-top: 5px">
                                        <label><strong>Tags</strong></label>
                                        <?php $print = false ?>
                                        <div class="col-md-12 row">
                                            @foreach($tags as $tag)
                                                @foreach($event->eventTag as $eTag)
                                                    @if($tag->id == $eTag->tag_id)
                                                        <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                            <input type="checkbox" name="tag[{{$tag->id}}]" class="custom-control-input" id="tag-{{$tag->id}}" checked>
                                                            <label class="custom-control-label" for="tag-{{$tag->id}}">{{ $tag->name }}</label>
                                                        </div>
                                                        <?php $print = true; ?>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($print == false)
                                                    <div class="custom-control custom-checkbox text-left" style="margin-right: 5px">
                                                        <input type="checkbox" name="tag[{{$tag->id}}]" class="custom-control-input" id="tag-{{$tag->id}}">
                                                        <label class="custom-control-label" for="tag-{{$tag->id}}">{{ $tag->name }}</label>
                                                    </div>
                                                @endif
                                                <?php $print = false ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!is_null($event->mainPicture) || count($event->pictures) != 0)
                            <div class="form-group modal-body text-left">
                                <label><strong>Imagens</strong></label><br>
                                <div class="row col-lg-12">
                                @if(!is_null($event->mainPicture))
                                    <div class="col-lg-4">
                                        <a class="btn btn-danger trash-image position-absolute" title="Excluir imagem" href="{{ route('del-img', ['id' => $event->mainPicture->id, 'redirect' => 'editar-evento?id='.$event->id]) }}"><i class="fa fa-trash"></i></a>
                                        <img class="imageable-main" src="data:image/png;base64, {{ $event->mainPicture->image }}" title="{{ $event->mainPicture->title }}" aria-label="Imagem principal do evento" alt="">
                                    </div>
                                @endif
                                @foreach($event->pictures as $picture)
                                    @if($picture->id != $event->mainPicture->id)
                                    <div class="col-lg-4">
                                        <a class="btn btn-danger trash-image position-absolute" title="Excluir imagem" href="{{ route('del-img', ['id' => $picture->id, 'redirect' => 'editar-evento?id='.$event->id]) }}"><i class="fa fa-trash"></i></a>
                                        <img class="imageable" src="data:image/png;base64, {{ $picture->image }}" title="{{ $picture->title }}" aria-label="Imagem do evento" alt="">
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="form-group modal-body text-left">
                                <label><strong>Descrição</strong></label>
                                <textarea class="form-control" name="description" style="height: 100px;" id="description" aria-label="Descrição do evento" required>{{ $event->description }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="{{ route('events') }}">Voltar</a>
                                <button class="btn btn-primary" type="submit">Salvar evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
