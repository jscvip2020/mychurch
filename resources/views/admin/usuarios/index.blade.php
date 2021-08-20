<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Usuarios')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cabecalho">
                        <h2>Lista Usuario</h2>
                        <div>
                            @can('user-create')
                                <a href="register" class="btn btn-sm btn-success"><i class="fa fa-plus">
                                        Adicionar</i></a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.__messages')
                        <table class="table table-success table-striped table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Regras</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1;?>
                            @foreach($rows as $row)
                                <tr>
                                    <th>{{ $n++ }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->usuario }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>@foreach($row->roles as $role) <a href="{{ route('roles.show', $role->id) }}" class="badge rounded-pill bg-success">{{$role->name}}</a>@endforeach</td>
                                    <td>
                                        <a class="{{ (!$row->status) ? 'text-danger' : 'text-success'}}" href="{{ route('usuarios.status',[$row->status,$row->id]) }}">
                                            @if($row->status)
                                                <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                                <i class="fa fa-2x fa-times-circle"></i>
                                                @endif
                                        </a>
                                    </td>
                                    <td class="action">
                                        @can('user-edit')
                                            <a href="{{ route('usuarios.edit',$row->id) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Editar"><i
                                                        class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('user-delete')
                                            <form class="float-right" id="form-delete{{$row->id}}"
                                                  action="{{ route('usuarios.destroy', $row->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="event.preventDefault();
                                                                if(confirm('Tem certeza que deseja excluir?')){
                                                                document.getElementById('form-delete{{$row->id}}').submit();
                                                                }"
                                                        class="btn btn-sm btn-danger"
                                                        title="Excluir"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $rows->onEachSide(1)->links() }}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection