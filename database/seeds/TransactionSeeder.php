<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            //Carbon::now(UTC +7) untuk WIB
            ['transaction_date'=>Carbon::now(), 'proof'=>'TAMBAH1','location_id'=>1, 'item_id'=>1, 'qty'=>100, 'program'=>'RECEIPT', 'user_id'=>1 ,'created_at'=>Carbon::now()],
            ['transaction_date'=>Carbon::now(), 'proof'=>'TAMBAH2','location_id'=>1, 'item_id'=>2, 'qty'=>80, 'program'=>'RECEIPT', 'user_id'=>1 ,'created_at'=>Carbon::now()],
        ]);
    }
}
