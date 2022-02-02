<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fornecedor extends Model
{   
    use SoftDeletes;                                         // fornecedores nome da tabela lá no banco
    protected $table = 'fornecedores'; //declarou o nome da tabela por ela ser no plural sem o s no final
    protected $fillable = ['nome', 'site', 'uf', 'email']; // libera metodos como create e delete nas colunas da tabela
   
    use HasFactory;      
    
    public function produtos(){          //nesse caso teve que indicar os id porque o model Item não foi criado automaticamente com o nome da tabela
        return $this->HasMany(Item::class, 'fornecedor_id','id');
    }
}
