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

        Team::find(1)->characters()->attach(1);
        Team::find(1)->characters()->attach(2);
        Team::find(1)->characters()->attach(3);

        Team::find(2)->characters()->attach(11);
        Team::find(2)->characters()->attach(12);
        Team::find(2)->characters()->attach(13);
    }
}
