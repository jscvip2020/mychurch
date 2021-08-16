<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 13/01/2021
 * Time: 14:43
 */ ?>

@extends('layouts.appMaster')

@section('titulo',' - Visualizando Permissões')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header titulo-table">
                        <h2 class="col-md-6">Visualizando permissões</h2>
                    </div>

                    <div class="card-body">
                        <div class="py-12">
                            <div class="container">
                                <div class="row">
                                        {{ $permission->name }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

