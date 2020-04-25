<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('__classes');
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'A',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '10',
            'name' => 'B',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'A',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '11',
            'name' => 'B',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'TEI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'TEDK',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'TOI',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'TPTU',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'IOP',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'MEKA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'SIJA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'RPL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'A',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $table->insert([
            'grade' => '12',
            'name' => 'B',
            'majors' => 'PFPT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
