<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Coursemodel;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('course')->insert([
            [
                'id_student' => 1941720080, // you can change this data
                'id' => 1,
                'score' => 'A',
            ],
            [
                'id_student' => 1941720074,
                'id' => 2,
                'score' => 'A',
            ],
            [
                'id_student' => 1941720000,
                'id' => 3,
                'score' => 'B',
            ],
            [
                'id_student' => 1941720071,
                'id' => 4,
                'score' => 'C+',
            ],

        ]);
    }
}
