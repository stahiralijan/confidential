<?php
	
	use App\User;
	use Illuminate\Database\Seeder;
	
	class DatabaseSeeder extends Seeder
	{
		/**
		 * Seed the application's database.
		 *
		 * @return void
		 */
		public function run()
		{
			$user = User::create([
									 'name'     => 'User 1',
									 'email'    => 'user@pesco.com.pk',
									 'password' => Hash::make('pakistan'),
								 ]);
			
			$this->call(PenaltyTypeSeeder::class);
			$this->call(PenaltySeeder::class);
			$this->call(StatusSeeder::class);
			$this->call(ChargeTableSeeder::class);
//			$this->call(EnquirySeeder::class);
//			$this->call(OfficeSeeder::class);
//			$this->call(DesignationSeeder::class);
//			$this->call(EmployeeSeeder::class);
//			$this->call(EnquiryCommitteeSeeder::class);
//			$this->call(EnquiryDetailSeeder::class);
//			$this->call(ActionTakenSeeder::class);
		}
	}