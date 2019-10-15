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
        factory(PenaltyType::class, 10)->create();
    }
}