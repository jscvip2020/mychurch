<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 13:39
 */ ?>

@extends('layouts.appMaster')

@section('titulo', ' - Noticias')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cabecalho">
                        <h2>Lista de Noticias</h2>
                        <div>
                            @can('user-create')
                                <a href="{{route('noticias.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus">
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
                                <th>Titulo</th>
                                <th>Destaque</th>
                                <th>Principal</th>
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
                                        @if($row->capa)
                                            <img src="{{ asset('images/noticias/'.$row->capa) }}" alt="{{ $row->titulo }}" width="80" height="60">
                                        @else
                                            <img src="{{ asset('images/noticias/default.jpg') }}" alt="{{ $row->titulo }}" width="80" height="60">
                                        @endif
                                    </td>
                                    <td class="align-items-center">{{ $row->titulo }}</td>
                                    <td>
                                        <a class="{{ (!$row->destaque) ? 'text-danger' : 'text-success'}}" href="{{ route('noticias.destaque',[$row->destaque,$row->id]) }}">
                                            @if($row->destaque)
                                                <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                                <i class="fa fa-2x fa-times-circle"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a class="{{ (!$row->dest_principal) ? 'text-danger' : 'text-success'}}" href="{{ route('noticias.principal',[$row->dest_principal,$row->id]) }}">
                                            @if($row->dest_principal)
                                                <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                                <i class="fa fa-2x fa-times-circle"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a class="{{ (!$row->status) ? 'text-danger' : 'text-success'}}" href="{{ route('noticias.status',[$row->status,$row->id]) }}">
                                            @if($row->status)
                                                <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                                <i class="fa fa-2x fa-times-circle"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td class="action">
                                        @can('noticia-edit')
                                            <a href="{{ route('noticias.edit',$row->id) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Editar"><i
                                                        class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('noticia-delete')
                                            <form class="float-right" id="form-delete{{$row->id}}"
                                                  action="{{ route('noticias.destroy', $row->id) }}"
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