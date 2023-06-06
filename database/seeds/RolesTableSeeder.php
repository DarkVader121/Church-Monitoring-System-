<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrCreate([
        	'name'	=> 'Chairman',
        	'label'	=> 'administrator',
        ]);

         $role = Role::firstOrCreate([
			
        	'name'	=> 'Parish Priest',
         	'label'	=> 'parish priest',
         ]);

		$role = Role::firstOrCreate([
			
			'name'	=> 'Commission Head',
		 	'label'	=> 'commission head',
		 ]);	

		$role = Role::firstOrCreate([
			'name'	=> 'PPC',
		 	'label'	=> 'ppc',
		 ]);	

		$role = Role::firstOrCreate([
		 	'name'	=> 'PFC',
			'label'	=> 'pfc',
		 ]);

    }
}
