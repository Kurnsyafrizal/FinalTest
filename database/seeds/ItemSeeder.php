<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_items')->insert([
            ['part'=>'AA-000000-00A', 'desc'=>'TRANSISTOR 54 OHM', 'um_id'=>1,'created_at'=>Carbon::now() ],
            ['part'=>'AA-000001-00A', 'desc'=>'TRANSISTOR 52 OHM', 'um_id'=>1,'created_at'=>Carbon::now() ],
        ]);
    }
}
