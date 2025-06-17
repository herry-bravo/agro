<?php

use App\Uom;
use Illuminate\Database\Seeder;

class UomTableSeeder extends Seeder
{
    public function run()
    {
		// DB::unprepared('SET IDENTITY_INSERT Uom ON');
        $uom = [
            [
                'id'        	 => 1,
                'uom_code'      => 'PCS',
				'uom_name'      => 'Pieces',
				'description'=> 'Unit of Quantity',
                'created_at' => '2019-09-15 06:09:29',
                'updated_at' => '2019-09-15 06:09:29',
            ],
            [
               'id'        	 => 2,
                'uom_code'      => 'KG',
				'uom_name'      => 'Kilogram',
				'description'=> 'Unit of Weight',
                'created_at' => '2019-09-15 06:09:29',
                'updated_at' => '2019-09-15 06:09:29',
            ],
        ];

        Uom::insert($uom);
		// DB::unprepared('SET IDENTITY_INSERT Uom Off');
    }
}
