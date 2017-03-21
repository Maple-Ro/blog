<?php

use Illuminate\Database\Seeder;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('info')->insert([
            'name' => 'MapleImage',
            'email' => 'liutsingluo@163.com',
            'description' => 'Hope is a good thing'
        ]);
        $register = new Registar();
    }
}
