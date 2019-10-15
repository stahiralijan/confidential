<?php

use App\ActionTaken;
use Illuminate\Database\Seeder;

class ActionTakenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ActionTaken::class, 10)->create();
    }
}