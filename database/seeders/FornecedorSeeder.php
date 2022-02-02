<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //o método create (atenção para o atributo fillable da classe)
        //instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 200';
        $fornecedor->site = 'fornecedor200.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor200.com.br';
        $fornecedor->save();

    }
}
