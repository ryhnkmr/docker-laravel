<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Userの一括削除
        User::truncate();

        for($i = 0; $i < 10; $i++){
            User::create([
                'name' => 'test'.$i,
                'email' => 'test'.$i.'@test.com',
                'password' => Hash::make('testtest'),
            ]);
        }

    }
}
