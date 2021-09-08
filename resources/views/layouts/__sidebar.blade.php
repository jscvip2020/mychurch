<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 09/01/2021
 * Time: 12:30
 */ ?>

<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <!-- sidebar-brand  -->
        <div class="sidebar-item sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ config('app.name', 'MyChurch 1.0') }}</a>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-item sidebar-header d-flex flex-nowrap">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{asset('images/user.jpg')}}" alt="usuario">
            </div>
            <div class="user-info">
                        <span class="user-name">
                            {{ Auth::user()->name }}
                        </span>
                <span class="user-role">
                @if(!empty(Auth::user()->getRoleNames()))
                        @foreach(Auth::user()->getRoleNames() as $v)
                            {{ $v }}
                        @endforeach
                    @endif
                </span>
                <span class="user-status">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class="fa fa-door-open"></i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </span>
            </div>
        </div>
        <!-- sidebar-search  -->
        <?php
        $index = explode(".", request()->route()->getName());
        //dd($index);
        ?>
        @if($index[0]!="")
            @if(isset($index[1]))
                @if($index[1]=='index')
                    <div class="sidebar-item sidebar-search">
                        <div>
                            <form action="{{ route(request()->route()->getName()) }}" method="get">
                                <div class="input-group">

                                    <input type="text" class="form-control search-menu" name="search"
                                           placeholder="buscar {{ $index[0] }}...">
                                    <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            @endif
        @endif
    @endif
    <!-- sidebar-menu  -->
        <div class=" sidebar-item sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li class="sidebar-dropdown {{ (
                request()->route()->getName()=='usuarios.index' OR
                request()->route()->getName()=='usuarios.create' OR
                request()->route()->getName()=='usuarios.edit' OR
                request()->route()->getName()=='roles.index' OR
                request()->route()->getName()=='roles.create' OR
                request()->route()->getName()=='roles.edit' OR
                request()->route()->getName()=='roles.show' OR
                request()->route()->getName()=='permissions.index' OR
                request()->route()->getName()=='permissions.create' OR
                request()->route()->getName()=='permissions.edit' OR
                request()->route()->getName()=='permissions.show')? 'active' :'' }}">
                    <a href="#">
                        <i class="fa fa-key"></i>
                        <span class="menu-text">Controle de acesso</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            @can('user-list')
                                <li class="{{ (request()->route()->getName()=='usuarios.index' OR request()->route()->getName()=='usuarios.create' OR request()->route()->getName()=='usuarios.edit')? 'active' :'' }}">
                                    <a href="{{ route('usuarios.index') }}">
                                        <i class="fa fa-user"></i>
                                        <span class="menu-text">Usuários</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role-list')
                                <li class="{{ (request()->route()->getName()=='roles.index' OR request()->route()->getName()=='roles.create' OR request()->route()->getName()=='roles.edit' OR request()->route()->getName()=='roles.show')? 'active' :'' }}">
                                    <a href="{{ route('roles.index') }}">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-text">Regras</span>
                                    </a>
                                </li>
                            @endcan
                            @can('permission-list')
                                <li class="{{ (request()->route()->getName()=='permissions.index' OR request()->route()->getName()=='permissions.create' OR request()->route()->getName()=='permissions.edit' OR request()->route()->getName()=='permissions.show')? 'active' :'' }}">
                                    <a href="{{ route('permissions.index') }}">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-text">Permissões</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @can('pastoral-list')
                    <li class="{{ (request()->route()->getName()=='pastorais.index' OR request()->route()->getName()=='pastorais.create' OR request()->route()->getName()=='pastorais.edit' OR request()->route()->getName()=='pastorais.show')? 'active' :'' }}">
                        <a href="{{ route('pastorais.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="menu-text">Pastorais</span>
                        </a>
                    </li>
                @endcan
                @can('rede-list')
                    <li class="{{ (request()->route()->getName()=='redes.index' OR request()->route()->getName()=='redes.create' OR request()->route()->getName()=='redes.edit' OR request()->route()->getName()=='redes.show')? 'active' :'' }}">
                        <a href="{{ route('redes.index') }}">
                            <i class="fas fa-network-wired"></i>
                            <span class="menu-text">Redes</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
</nav>