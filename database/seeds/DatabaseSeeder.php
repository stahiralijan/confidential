<?php

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
        $this->call(PenaltyTypeSeeder::class);
        $this->call(PenaltySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(EnquirySeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EnquiryCommitteeSeeder::class);
        $this->call(EnquiryDetailSeeder::class);
        $this->call(ActionTakenSeeder::class);
    }
}