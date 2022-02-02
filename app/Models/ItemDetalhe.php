<?php

namespace App\Models;     //MOdel criado para demonstrar como utilizar um model com nomes diferentes no banco

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    use HasFactory;
    protected $table = 'produto_detalhes';
    protected $fillable = ['produto_id','comprimento','altura','largura','unidade_id'];

    public function Item() {
        return $this->belongsTo(Item::class, 'produto_id', 'id');  //has one faz a fk
    }
}
