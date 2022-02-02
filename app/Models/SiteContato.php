<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContato extends Model
{
    use HasFactory;
    protected $fillable = ['motivo_contatos_id','nome','telefone','email','mensagem'];
}
