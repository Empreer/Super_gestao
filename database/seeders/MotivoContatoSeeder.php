<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\MotivoContato;

class MotivoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exporta= new MotivoContato();
        $exporta->motivo_contato = 'Dúvida';
        $exporta->save();


        $exporta= new MotivoContato();
        $exporta->motivo_contato = 'Reclamação';
        $exporta->save();
       
        $exporta= new MotivoContato();
        $exporta->motivo_contato = 'Elogio';
        $exporta->save();
    }
}
