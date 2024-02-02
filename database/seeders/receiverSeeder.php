<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\receiver;

use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;
class receiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Faker = Faker::create();

        for($i=0; $i<100; $i++){
            $receiver = new receiver;
            $receiver->name = $Faker->name;
            $receiver->email = $Faker->email;
            $receiver->password = Hash::make($Faker->password);
            $saveSuccess = $receiver->save();
       }
       
    }
}
