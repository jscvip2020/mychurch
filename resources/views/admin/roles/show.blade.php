<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 13/01/2021
 * Time: 14:43
 */ ?>

@extends('layouts.appMaster')

@section('titulo',' - Visualizando Regra')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header titulo-table">
                        <h2 class="col-md-6">Visualizando Regra {{ $role->name }}</h2>
                    </div>

                    <div class="card-body">
                        <div class="py-12">
                            <div class="container">
                                <div class="row">
                                    @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            <label class="badge fa-1x badge-success mr-2">{{ $v->name }}, </label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

