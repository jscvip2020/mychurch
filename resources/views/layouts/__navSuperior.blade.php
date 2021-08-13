<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 12:31
 */ ?>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @can('especialidade-list')
                    <li class="nav-item {{ (request()->is('especialidades*')) ? 'active' : '' }}">
                        <a href="{{ route('especialidades.index') }}" class="nav-link">Especialidades</a>
                    </li>
                @endcan
                @can('medico-list')
                    <li class="nav-item {{ (request()->is('medicos*')) ? 'active' : '' }}">
                        <a href="{{ route('medicos.index') }}" class="nav-link">Médicos</a>
                    </li>
                @endcan
                @can('convenio-list')
                    <li class="nav-item {{ (request()->is('convenios*')) ? 'active' : '' }}">
                        <a href="{{ route('convenios.index') }}" class="nav-link">Convênios</a>
                    </li>
                @endcan
                @can('paciente-list')
                    <li class="nav-item {{ (request()->is('pacientes*')) ? 'active' : '' }}">
                        <a href="{{ route('pacientes.index') }}" class="nav-link">Pacientes</a>
                    </li>
                @endcan

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('user-list')
                                <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fa fa-user">
                                        Usuários</i></a>
                            @endcan
                            @can('role-list')
                                <a class="dropdown-item" href="{{ route('roles.index') }}"><i class="fa fa-scroll">
                                        Regras</i></a>
                            @endcan
                            @can('permission-list')
                                <a class="dropdown-item" href="{{ route('permissions.index') }}"><i class="fa fa-key">
                                        Permissões</i></a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>