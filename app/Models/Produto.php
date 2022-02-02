<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome','descricao','peso','unidade_id'];

    public function produtoDetalhe() {
        return $this->hasOne(ProdutoDetalhe::class);  //has one faz a fk
    }
    
    public function pedido(){ // como a classe item está despadronizada teve que colocar mais dois parametros....
        return $this->belongsToMany(Pedido::class,'pedidoprodutos');
    }
    
    //Produto tem 1 produtoDetalhe

        //1 registro relacionado em produto_detalhes (fk) -> produto_id
        //produtos (pk) -> id

}
