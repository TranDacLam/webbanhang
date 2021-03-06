<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        	[
                'full_name' => 'Trần Lâm',
            	'email' => 'lam@lam.com',
            	'password' => bcrypt('121212'),
            	'level' => 1,
            	'created_at' => new DateTime(), 
	        ]
	    );
    }
}
