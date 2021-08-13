<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 31/03/2021
 * Time: 14:21
 */ ?>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif