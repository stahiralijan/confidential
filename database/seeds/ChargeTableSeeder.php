<?php

use Illuminate\Database\Seeder;

class ChargeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Charge::create([
								'name' => 'Corruption',
								'description' => '',
							]);
	
		\App\Charge::create([
								'name' => 'Fatal Accident',
								'description' => '',
							]);
	
		\App\Charge::create([
								'name' => 'Absentee',
								'description' => '',
							]);
	
		\App\Charge::create([
								'name' => 'Subordination',
								'description' => '',
							]);
	
		\App\Charge::create([
								'name' => 'Criminal Negligence',
								'description' => '',
							]);
    }
}
