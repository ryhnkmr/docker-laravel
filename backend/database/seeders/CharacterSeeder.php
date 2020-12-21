<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Userの一括削除
        Character::truncate();

        for($i = 0; $i < 10; $i++){
            Character::create([
                'name' => 'test'.$i,
                'user_id' => 1,
                'hp' => 3000,
                'ap' => 500,
                'dp'=> 400,
                'exp'=>0,
                'lv'=>1,
                'thumnailURL'=>'hoge',
                'pictoURL'=>'hoge',
            ]);
        }

        for($i = 0; $i < 10; $i++){
            Character::create([
                'name' => 'test'.$i,
                'user_id' => 2,
                'hp' => 3000,
                'ap' => 500,
                'dp'=> 400,
                'exp'=>0,
                'lv'=>1,
                'thumnailURL'=>'hoge',
                'pictoURL'=>'hoge',
            ]);
        }
    }
}
