<?php

namespace Database\Seeders;

use App\Models\Entete;
use Illuminate\Database\Seeder;

class EnteteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'code_etablissement' => '30001',
            'titre'=>'Hopital Ophtalmologique',
            'desc'=>'Spécialiste Ophtalmo',
            'adresse'=>'Hassi messaoud',
            'wilaya'=>'30',
            'phone'=>'0671483234',
            'fax'=>'029715346',
            'email'=>'ChibaneMourad1@gmail.com',
            'logo'=>'/dist/img/logo.png'
        ];
        Entete::insert($data);
    }
}
