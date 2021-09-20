<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Criando Noticia')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Criando...') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('noticias.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="titulo" class="col-md-3 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-8">
                                    <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autofocus>

                                    @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug" class="col-md-3 col-form-label text-md-right">{{ __('Slug') }}</label>

                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" readonly>

                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="resumo" class="col-md-3 col-form-label text-md-right">{{ __('Resumo') }}</label>

                                <div class="col-md-8">
                                    <input id="resumo" type="text" class="form-control @error('resumo') is-invalid @enderror" name="resumo" value="{{ old('resumo') }}" required>

                                    @error('resumo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="texto" class="col-md-3 col-form-label text-md-right">{{ __('Texto') }}</label>

                                <div class="col-md-8">
                                    <textarea id="texto" type="text" class="form-control @error('texto') is-invalid @enderror" name="texto" required>{{ old('texto') }}</textarea>

                                    @error('texto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="publisher" class="col-md-3 col-form-label text-md-right">{{ __('Quem ta publicando') }}</label>

                                <div class="col-md-5">
                                    <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') ? old('publisher') : Auth()->user()->name }}">

                                    @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="capa" class="col-md-3 col-form-label text-md-right">{{ __('Imagem') }}</label>

                                <div class="col-md-5">
                                    <input type="file" class="form-control @error('capa') is-invalid @enderror"
                                           name="capa">
                                    <img class="img_inputFileRet">
                                    <small id="emailHelp" class="form-text text-muted">Escolha uma imagem para a capa da notícia. Tamanho 800x600 px.</small>
                                    @error('capa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-info text-white">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery.stringToSlug.min.js') }}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
        CKEDITOR.replace('texto', {
            toolbar: [
                { name: 'document', items: [ 'Source' ] },
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'insert', items: [ 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
            ],

        });
        $("#titulo").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).next()
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                $('.img_inputFileRet').show();
            }
            else {
                $('.img_inputFileRet').hide();
                var img = input.value;
                $(input).next().attr('src', img);
            }
        }

        $('input[type=file]').on("change", function () {
            $('input[type=file]').each(function (index) {
                if ($('input[type=file]').eq(index).val() != "") {
                    readURL(this);
                }
            });
        });
    </script>
@endsection