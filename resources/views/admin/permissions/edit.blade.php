@extends('layouts.appMaster')
@section('titulo', ' - Alterando Permissões')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alterar Permissões</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="oldname" value="{{ explode("-",$permission->name)[0] }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Name') }} do Modelo</label>

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') ? explode("-",old('name'))[0] : explode("-",$permission->name)[0] }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Alterar Permissões
                                    </button>
                                    <a href="{{ route('permissions.index') }}" class="btn btn-danger"> Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
