<?php

use App\Penalty;
use Illuminate\Database\Seeder;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penalty::create([
							'name' => 'Termination',
							'description' => 'Termination',
							'penalty_type_id' => 1
						]);
	
		Penalty::create([
							'name' => 'Without Pay',
							'description' => 'Without Pay',
							'penalty_type_id' => 1
						]);
	
		Penalty::create([
							'name' => 'Step Down',
							'description' => 'Step Down',
							'penalty_type_id' => 1
						]);
	
		Penalty::create([
							'name' => 'Dismiss',
							'description' => 'Dismiss',
							'penalty_type_id' => 1
						]);
	
		Penalty::create([
							'name' => 'Censure',
							'description' => 'Censure',
							'penalty_type_id' => 2
						]);
    }
}