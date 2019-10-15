<?php
	
	use App\PenaltyType;
	use Illuminate\Database\Seeder;
	
	class PenaltyTypeSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			PenaltyType::create([
									'name'        => 'Major',
									'description' => 'Major Penalty',
								]);
			
			PenaltyType::create([
									'name'        => 'Minor',
									'description' => 'Minor Penalty',
								]);
		}
	}