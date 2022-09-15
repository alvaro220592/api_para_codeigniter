<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosWebservice extends Model
{
    use HasFactory;

    protected $table = 'registros_webservice';

    protected $fillable = [
        'nosso_numero',
        'flg_pago',
        'data_pagto',
        'obs',
        'data_registro',
    ];
}
