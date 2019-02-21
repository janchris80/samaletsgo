<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Owner',
            'slug' => 'owner',
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Member',
            'slug' => 'member',
            'created_at' => '2019-01-01 12:59:59',
            'updated_at' => '2019-01-01 12:59:59',
        ]);
    }
}
