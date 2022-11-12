<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $grades = [
              ['id' => 1, 'grade' => 'A+', 'term' => 'Senior', 'upper_limit' => 100, 'lower_limit' => 90],
              ['id' => 2, 'grade' => 'A', 'term' => 'Scholar', 'upper_limit' => 89, 'lower_limit' => 70],
              ['id' => 3, 'grade' => 'B', 'term' => 'Boss', 'upper_limit' => 69, 'lower_limit' => 60],
              ['id' => 4, 'grade' => 'C', 'term' => 'Surviver', 'upper_limit' => 59, 'lower_limit' => 50],
              ['id' => 5, 'grade' => 'D', 'term' => 'On God', 'upper_limit' => 45, 'lower_limit' => 49],
              ['id' => 6, 'grade' => 'E', 'term' => 'God abeg', 'upper_limit' => 44, 'lower_limit' => 40],
              ['id' => 7, 'grade' => 'F', 'term' => 'Agbafiriyoyo', 'upper_limit' => 39 , 'lower_limit' => 0],
         ];
        DB::table('grades')->insert($grades);
    }
}
