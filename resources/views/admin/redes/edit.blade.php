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
                        <form method="POST" action="{{ route('redes.update',$row->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="nome" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-7">
                                    <input id="nome" type="text"
                                           class="form-control @error('nome') is-invalid @enderror" name="nome"
                                           value="{{ ($row->nome) ? $row->nome : old('nome') }}" readonly>

                                    @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rede"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Media Social') }}</label>

                                <div class="col-md-5">
                                    <select id="rede" class="form-control @error('icone') is-invalid @enderror" name="icone">
                                        <option value="fa fa-facebook" {{($row->icone == "fa fa-facebook") ? 'selected' : ''}}>Facebook</option>
                                        <option value="fa fa-instagram" {{($row->icone == "fa fa-instagram") ? 'selected' : ''}}>Instagram</option>
                                        <option value="fa fa-linkedin" {{($row->icone == "fa fa-linkedin") ? 'selected' : ''}}>Linkedin</option>
                                        <option value="fa fa-pinterest" {{($row->icone == "fa fa-pinterest") ? 'selected' : ''}}>Pinterest</option>
                                        <option value="fa fa-telegram" {{($row->icone == "fa fa-telegram") ? 'selected' : ''}}>Telegram</option>
                                        <option value="fa fa-twitch" {{($row->icone == "fa fa-twitch") ? 'selected' : ''}}>Twitch</option>
                                        <option value="fa fa-twitter" {{($row->icone == "fa fa-twitter") ? 'selected' : ''}}>Twitter</option>
                                        <option value="fa fa-whatsapp" {{($row->icone == "fa fa-whatsapp") ? 'selected' : ''}}>Whatsapp</option>
                                        <option value="fa fa-youtube" {{($row->icone == "fa fa-youtube") ? 'selected' : ''}}>Youtube</option>
                                    </select>

                                    @error('icone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <span> <i id="icone" class="{{ ($row->icone) ? $row->icone : old('icone') }} fa-2x"></i></span>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-md-3 col-form-label text-md-right">{{ __('URL') }}</label>

                                <div class="col-md-7">
                                    <input type="text"
                                           class="form-control @error('url') is-invalid @enderror" name="url"
                                           value="{{ ($row->url) ? $row->url : old('url') }}">
                                    @error('url')
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
        $("#rede").change(function() {
            var select = document.getElementById("rede");
            var icone = document.getElementById("icone");
            var opcaoTexto = select.options[select.selectedIndex].text;
            var opcaoValor = select.options[select.selectedIndex].value;
            $("#nome").val(opcaoTexto);
            icone.className = opcaoValor + " fa-2x";
        });
    </script>
@endsection