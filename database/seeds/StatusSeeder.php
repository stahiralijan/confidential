<?php
	
	use App\Status;
	use Illuminate\Database\Seeder;
	
	class StatusSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			Status::create([
							   'name'        => 'Pending',
							   'description' => 'Pending',
						   ]);
			
			Status::create([
							   'name'        => 'Completed',
							   'description' => 'Completed',
						   ]);
			
			Status::create([
							   'name'        => 'In Progress',
							   'description' => 'In Progress',
						   ]);
			
			Status::create([
							   'name'        => 'Withdrawn',
							   'description' => 'Withdrawn',
						   ]);
		}
	}