<?php

use Illuminate\Database\Seeder;

class TblConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_config')->delete();
        
        \DB::table('tbl_config')->insert(array (
            0 => 
            array (
                'name' => 'contrato',
                'value' => '1',
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ),
        ));
    }
}
