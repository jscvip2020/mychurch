<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Criando Pastoral')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">{{ __('Criando...') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pastorais.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="nome" type="text"
                                           class="form-control @error('nome') is-invalid @enderror" name="nome"
                                           value="{{ old('nome') }}" required autofocus>

                                    @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="imagem"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>
                                <div class="col-md-6">
                                    <!-- image-preview-filename input [CUT FROM HERE]-->
                                    <div class="input-group image-preview @error('imagem') is-invalid @enderror">
                                        <input type="text" class="form-control image-preview-filename"
                                               disabled="disabled">
                                        <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear"
                                                    style="display:none;">
                                                <span class="fa fa-times"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-light image-preview-input">
                                                <span class="fa fa-folder-open"></span>
                                                <span class="image-preview-input-title">Browse</span>
                                                <input type="file" name="imagem"/>
                                                <!-- rename it -->
                                            </div>
                                        </span>
                                    </div><!-- /input-group image-preview [TO HERE]-->
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