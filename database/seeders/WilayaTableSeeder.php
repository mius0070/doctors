<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'lib_wilaya' => 'ADRAR'],
            ['id' => 16, 'lib_wilaya' => 'ALGER'],
            ['id' => 4, 'lib_wilaya' => 'AIN-DEFLA'],
            ['id' => 46, 'lib_wilaya' => 'IN-TEMOUCHENT'],
            ['id' => 23, 'lib_wilaya' => 'ANNABA'],
            ['id' => 5, 'lib_wilaya' => 'BATNA'],
            ['id' => 8, 'lib_wilaya' => 'BECHAR'],
            ['id' => 6, 'lib_wilaya' => 'BEJAIA'],
            ['id' => 7, 'lib_wilaya' => 'BISKRA'],
            ['id' => 9, 'lib_wilaya' => 'BLIDA'] ,
            ['id' => 34, 'lib_wilaya' => 'BORDJ-BOU-ARRERIDJ'],
            ['id' => 10, 'lib_wilaya' => 'BOUIRA'],
            ['id' => 35, 'lib_wilaya' => 'BOUMERDES'],
            ['id' => 2, 'lib_wilaya' => 'CHLEF'],
            ['id' => 25, 'lib_wilaya' => 'CONSTANTINE'],
            ['id' => 17, 'lib_wilaya' => 'DJELFA'],
            ['id' => 32, 'lib_wilaya' => 'EL-BAYADH'],
            ['id' => 39, 'lib_wilaya' => 'EL-OUED'],
            ['id' => 36, 'lib_wilaya' => 'EL-TARF'],
            ['id' => 47, 'lib_wilaya' => 'GHARDAIA'],
            ['id' => 24, 'lib_wilaya' => 'GUELMA'],
            ['id' => 33, 'lib_wilaya' => 'ILLIZI'],
            ['id' => 18, 'lib_wilaya' => 'JIJEL'],
            ['id' => 40, 'lib_wilaya' => 'KHENCHELA'],
            ['id' => 3, 'lib_wilaya' => 'LAGHOUAT'],
            ['id' => 28, 'lib_wilaya' => 'M\'SILA'],
            ['id' => 29, 'lib_wilaya' => 'MASCARA'],
            ['id' => 26, 'lib_wilaya' => 'MEDEA'],
            ['id' => 43, 'lib_wilaya' => 'MILA'],
            ['id' => 27, 'lib_wilaya' => 'MOSTAGANEM'],
            ['id' => 45, 'lib_wilaya' => 'NAAMA'],
            ['id' => 31, 'lib_wilaya' => 'ORAN'],
            ['id' => 30, 'lib_wilaya' => 'OUARGLA'],
            ['id' => 4, 'lib_wilaya' => 'OUM-EL-BOUAGHI'],
            ['id' => 48, 'lib_wilaya' => 'RELIZANE'],
            ['id' => 20, 'lib_wilaya' => 'SAIDA'],
            ['id' => 19, 'lib_wilaya' => 'SETIF'],
            ['id' => 22, 'lib_wilaya' => 'SIDI BEL ABBES'],
            ['id' => 21, 'lib_wilaya' => 'SKIKDA'],
            ['id' => 41, 'lib_wilaya' => 'SOUK-AHRAS'],
            ['id' => 11, 'lib_wilaya' => 'TAMANRASSET'],
            ['id' => 12, 'lib_wilaya' => 'TEBESSA'],
            ['id' => 14, 'lib_wilaya' => 'TIARET'],
            ['id' => 37, 'lib_wilaya' => 'TINDOUF'],
            ['id' => 42, 'lib_wilaya' => 'TIPAZA'],
            ['id' => 38, 'lib_wilaya' => 'TISSEMSILT'],
            ['id' => 15, 'lib_wilaya' => 'TIZI OUZOU'],
            ['id' => 13, 'lib_wilaya' => 'TLEMCEN'],
            ['id' => 99, 'lib_wilaya' => 'ETRANGER'],
        ];
        Wilaya::insert($data);
    }
}
