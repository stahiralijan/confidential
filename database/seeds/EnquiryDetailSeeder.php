<?php

use App\EnquiryDetail;
use Illuminate\Database\Seeder;

class EnquiryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EnquiryDetail::class, 10)->create();
    }
}