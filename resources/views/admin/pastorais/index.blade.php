<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Pastorais')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cabecalho">
                        <h2>Lista de Pastorais</h2>
                        <div>
                            @can('user-create')
                                <a href="{{route('pastorais.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus">
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
                                <th></th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1;?>
                            @foreach($rows as $row)
                                <tr>
                                    <th>{{ $n++ }}</th>
                                    <td>
                                        @if($row->imagem)
                                            <img src="{{ asset('images/pastoral/'.$row->imagem) }}" alt="{{ $row->nome }}" width="60" height="60">
                                        @endif
                                    </td>
                                    <td class="align-content-center">{{ $row->nome }}</td>
                                    <td>
                                        <a class="{{ (!$row->status) ? 'text-danger' : 'text-success'}}" href="{{ route('pastorais.status',[$row->status,$row->id]) }}">
                                            @if($row->status)
                                                <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                                <i class="fa fa-2x fa-times-circle"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td class="action">
                                        @can('pastoral-edit')
                                            <a href="{{ route('pastorais.edit',$row->id) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Editar"><i
                                                        class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('pastoral-delete')
                                            <form class="float-right" id="form-delete{{$row->id}}"
                                                  action="{{ route('pastorais.destroy', $row->id) }}"
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