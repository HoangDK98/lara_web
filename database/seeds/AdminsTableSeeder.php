<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [   
                'name'=>'Admin',
                'phone'=>'123456789',
                'email'=>'admin123@gmail.com',
                'password'=>bcrypt('admin123'),
            ]
        ];
        DB::table('admins')->insert($data);
    }
}
