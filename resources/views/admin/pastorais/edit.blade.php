<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Editando Pastoral')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Editando...') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pastorais.update',$row->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') ? old('nome') : $row->nome }}" required autofocus>

                                    @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="imagem" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                                <div class="col-md-6">
                                        <input type="file" class="form-control @error('imagem') is-invalid @enderror"
                                               name="imagem">
                                    <img class="img_inputFile">
                                    @error('imagem')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-info text-white">
                                        {{ __('Atualiza') }}
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).next()
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                $('.img_inputFile').show();
            }
            else {
                $('.img_inputFile').hide();
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
