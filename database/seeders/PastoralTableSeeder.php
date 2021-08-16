<?php

namespace Database\Seeders;

use App\Models\Pastoral;
use Illuminate\Database\Seeder;

class PastoralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pastorais = [
                'Pastoral Afro-Brasileira',
                'Pastoral Carcerária',
                'Pastoral da Catequese',
                'Pastoral da Comunicação - PASCOM',
                'Pastoral da Criança',
                'Pastoral da Cultura',
                'Pastoral da Educação',
                'Pastoral da Juventude',
                'Pastoral da Juventude do Meio Popular',
                'Pastoral da Juventude Estudantil',
                'Pastoral da Juventude Rural',
                'Pastoral da Liturgia',
                'Pastoral da Mobilidade Humana',
                'Pastoral da Mulher Marginalizada - PMM',
                'Pastoral da Música',
                'Pastoral da Pessoa Idosa',
                'Pastoral da Sacristia',
                'Pastoral da Saúde',
                'Pastoral da Sobriedade',
                'Pastoral da Terra',
                'Pastoral de DST/AIDS',
                'Pastoral do Batismo',
                'Pastoral do Catecumenato',
                'Pastoral do Dízimo',
                'Pastoral do Menor',
                'Pastoral do Povo da Rua',
                'Pastoral do Surdo',
                'Pastoral do Turismo',
                'Pastoral dos Apóstolos Eucarísticos da Divina Misericórdia – AEDM’s',
                'Pastoral dos Brasileiros no Exterior',
                'Pastoral dos Coroinhas (e acólitos)',
                'Pastoral dos Migrantes',
                'Pastoral dos Ministros Extraordinários da Sagrada Comunhão',
                'Pastoral dos Movimentos de Obras de Misericórdia – MOM',
                'Pastoral dos Nômades',
                'Pastoral dos Pescadores',
                'Pastoral dos Refugiados',
                'Pastoral dos Terços e Novenas em Família',
                'Pastoral Familiar',
                'Pastoral Operária',
                'Pastoral Rodoviária',
                'Pastoral Social',
                'Pastoral Universitária',
                'Pastoral Vocacional',
        ];

        foreach ($pastorais as $pastoral) {
            Pastoral::create(['nome' => $pastoral]);
        }
    }
}
