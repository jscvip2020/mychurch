<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.app')

@section('titulo', ' - Editando Usuário')

@section('content')
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">{{ __('Editando...') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.update',$row->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $row->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror"
                                           name="usuario" value="{{ old('usuario') ? old('usuario') : $row->usuario }}" required autocomplete="usuario">

                                    @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $row->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="roles[]" class="col-md-4 col-form-label text-md-right">Regras</label>

                                <div class="col-md-6">
                                    <select name="roles[]" class="form-control @error('roles') is-invalid @enderror" multiple>
                                        <option value=""></option>
                                        @foreach($roles as $key => $value)
                                            <option value="{{ $key }}" {{ in_array($key, $userRole) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
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
