@extends('layouts.appMaster')
@section('titulo', ' - Registrando Regra')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar Regra</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>

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

                            <div class="form-group row">
                                <label for="permission[]"
                                       class="col-md-12 col-form-label">Permissões</label>

                                <div class="col-md-12">
                                    <?php $teste = 'test';?>
                                    @foreach($permission as $value)
                                        <?php $nome = explode("-", $value->name);?>
                                        @if($teste != $nome[0])
                                            <br>
                                            <?php $teste = $nome[0]; ?>
                                        @endif
                                        <div class="d-inline-flex" style="width: 150px">
                                            <input class="mr-1" type="checkbox" name="permission[]" value="{{ $value->id }}"> {{ $value->name }}
                                        </div>
                                    @endforeach
                                    @error('permission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar Regra
                                    </button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger"> Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
