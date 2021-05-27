<?php

use Automacao\Models\Componente;
use Illuminate\Database\Seeder;


class ComponentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            [
                'id' => 1,    
                'nome' => 'Led Vermelho - Sala',
                'pino' => 2
            ],
            [
                'id' => 2,
                'nome' => 'Led Amarelo - Cozinha',
                'pino' => 3
            ],
            [
                'id' => 3,
                'nome' => 'Led Verde - Quarto',
                'pino' => 4
            ]
        ];
        foreach($dados as $dado) {
            $componente = Componente::find($dado['id']);
            if (empty($componente)) {
                Componente::create($dado);
            } else {
                Componente::where('id', $dado['id'])->update($dado);
            }
       
        }
    }
}
