<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
            'name'=>'Chibane Mourad',
            'birthday'=>'1994-11-18',
            'email'=>'chibanemourad1@gmail.com',
            'username'=>'doctor',
            'password'=>'$2y$10$a1vVE0RVG4VMbCIs7Mizku1Y2XdoFug2T2I4YwA1erh7YX1Nc7qty',
            'type'=>'1',
            'service'=>'1',
            'role'=>'0',
            'is_visible'=>'1',
            ],
            [
            'name'=>'Chibane Yacine',
            'birthday'=>'2004-05-05',
            'email'=>'chibaneyacine@gmail.com',
            'username'=>'admin',
            'password'=>'$2y$10$a1vVE0RVG4VMbCIs7Mizku1Y2XdoFug2T2I4YwA1erh7YX1Nc7qty',
            'type'=>'0',
            'service'=>'1',
            'role'=>'0',
            'is_visible'=>'1',
            ]

        ];

        User::insert($data);
    }
}
