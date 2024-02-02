<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\giver;

use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;
class giverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Faker = Faker::create();

        for($i=0; $i<100; $i++){
            $giver = new giver;
            $giver->name = $Faker->name;
            $giver->email = $Faker->email;
            $giver->password = Hash::make($Faker->password);
            $saveSuccess = $giver->save();
       }
       
    }
}
