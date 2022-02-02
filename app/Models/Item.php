<?php

namespace App\Models;    //MOdel criado para demonstrar como utilizar um model com nomes diferentes no banco

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = ['nome','descricao','peso','unidade_id','fornecedor_id'];

    public function itemDetalhe() {    //fk tab produto  chave tabela produto detalhes
    return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');  //has one faz a fk
    }

    public function fornecedor() {    //fk tab produto  chave tabela produto detalhes
        return $this->belongsTo(Fornecedor::class);
    }

    public function pedido(){ // como a classe item está despadronizada teve que colocar mais dois parametros....
        return $this->belongsToMany(Pedido::class,'pedidoprodutos','produto_id','pedido_id');
    }
}
