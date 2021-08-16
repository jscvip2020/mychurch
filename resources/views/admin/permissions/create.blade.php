@extends('layouts.appMaster')
@section('titulo', ' - Registrando Permissão')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar Permissão</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Name') }} do Modelo</label>

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                        Registrar Permissão
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
