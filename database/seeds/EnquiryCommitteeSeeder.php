<?php

use App\EnquiryCommittee;
use Illuminate\Database\Seeder;

class EnquiryCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EnquiryCommittee::class, 10)->create();
    }
}