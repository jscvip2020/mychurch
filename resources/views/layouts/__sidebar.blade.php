<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 09/01/2021
 * Time: 12:30
 */ ?>


<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('welcome') }}" target="_blank">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/church.svg') }}" width="100%" alt="logo {{ config('app.name', 'MyChurch 1.0') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'MyChurch 1.0') }}</div>
    </a>
    <hr class="sidebar-divider my-0">
            <div class="text-center mt-2">Menu</div></a>
    <hr class="sidebar-divider">
    <!-- sidebar-menu  -->
    <li class="nav-item {{ (
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fa fa-key"></i>
            <span>Controle de acesso</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('user-list')
                    <a class="collapse-item {{ (request()->route()->getName()=='usuarios.index' OR request()->route()->getName()=='usuarios.create' OR request()->route()->getName()=='usuarios.edit')? 'active' :'' }}"
                       href="{{ route('usuarios.index') }}">
                        <i class="fa fa-user"></i>
                        <span class="menu-text">Usuários</span>
                    </a>
                @endcan
                @can('role-list')
                    <a class="collapse-item {{ (request()->route()->getName()=='roles.index' OR request()->route()->getName()=='roles.create' OR request()->route()->getName()=='roles.edit' OR request()->route()->getName()=='roles.show')? 'active' :'' }}"
                       href="{{ route('roles.index') }}">
                        <i class="fa fa-book"></i>
                        <span class="menu-text">Regras</span>
                    </a>
                @endcan
                @can('permission-list')
                    <a class="collapse-item {{ (request()->route()->getName()=='permissions.index' OR request()->route()->getName()=='permissions.create' OR request()->route()->getName()=='permissions.edit' OR request()->route()->getName()=='permissions.show')? 'active' :'' }}"
                       href="{{ route('permissions.index') }}">
                        <i class="fa fa-book"></i>
                        <span class="menu-text">Permissões</span>
                    </a>
                @endcan
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    @can('pastoral-list')
        <li class="nav-item  {{ (request()->route()->getName()=='pastorais.index' OR request()->route()->getName()=='pastorais.create' OR request()->route()->getName()=='pastorais.edit' OR request()->route()->getName()=='pastorais.show')? 'active' :'' }}">
            <a class="nav-link" href="{{ route('pastorais.index') }}">
                <i class="fa fa-users"></i>
                <span class="menu-text">Pastorais</span>
            </a>
        </li>
    @endcan
    @can('rede-list')
        <li class="nav-item {{ (request()->route()->getName()=='redes.index' OR request()->route()->getName()=='redes.create' OR request()->route()->getName()=='redes.edit' OR request()->route()->getName()=='redes.show')? 'active' :'' }}">
            <a class="nav-link" href="{{ route('redes.index') }}">
                <i class="fas fa-network-wired"></i>
                <span class="menu-text">Redes</span>
            </a>
        </li>
    @endcan
    @can('noticia-list')
        <li class="nav-item {{ (request()->route()->getName()=='noticias.index' OR request()->route()->getName()=='noticias.create' OR request()->route()->getName()=='noticias.edit' OR request()->route()->getName()=='noticias.show')? 'active' :'' }}">
            <a class="nav-link" href="{{ route('noticias.index') }}">
                <i class="fas fa-newspaper"></i>
                <span class="menu-text">Notícias</span>
            </a>
        </li>
    @endcan

    <hr class="sidebar-divider">
    <div class="version" >JS'Cordeiro Programas - Version 1.0</div>
    <!-- sidebar-menu  -->

</ul>
<!-- Sidebar -->