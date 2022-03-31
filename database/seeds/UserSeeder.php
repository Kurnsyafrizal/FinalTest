<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name'=>'ADITYA', 'phone'=>'11111', 'email'=>'aditya@mail.com', 'password'=>Hash::make('aditya123') ,'created_at'=>Carbon::now()],
        ]);
    }
}
