<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $roles = [
              ['id' => 1, 'role' => 'user'],
              ['id' => 2, 'role' => 'admin'],
              ['id' => 3, 'role' => 'editor'],
              ['id' => 4, 'role' => 'author'],
         ];
        DB::table('roles')->insert($roles);
    }
}
