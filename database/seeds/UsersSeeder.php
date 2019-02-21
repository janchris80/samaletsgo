<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'first_name' => 'Mary Grace',
            'middle_name' => '',
            'last_name' => 'Puyot',
            'email' => 'grace@fakemail.com',
            'username' => 'admin',
            'password' => bcrypt('123123'),
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'first_name' => 'Kathleen Kaye',
            'middle_name' => '',
            'last_name' => 'Soliva',
            'email' => 'kate@fakemail.com',
            'username' => 'kayesoliva',
            'password' => bcrypt('123123'),
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'first_name' => 'Kharmella',
            'middle_name' => '',
            'last_name' => 'Lacap',
            'email' => 'lacap@fakemail.com',
            'username' => 'lacap123',
            'password' => bcrypt('123123'),
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);
    }
}
