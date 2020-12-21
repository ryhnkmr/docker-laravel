<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Team::truncate();

        Team::create([
            'name' => 'test',
            'user_id' => 1,
        ]);

        Team::create([
            'name' => 'test2',
            'user_id' => 2,
        ]);
    }
}
