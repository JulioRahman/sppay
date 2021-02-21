<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $n = 10;
        $nis = 161112644;
        $student = array();
        for ($i = 0; $i < $n; $i++) {
            $student[] = $faker->name;
        }
        sort($student);

        $table = DB::table('students');
        for ($i = 0; $i < $n; $i++) {
            $table->insert([
                'nisn' => $faker->numerify('001#######'),
                'nis' => strval($nis + $i),
                'student_name' => $student[$i],
                '__class_id' => '16',
                'spp_id' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
