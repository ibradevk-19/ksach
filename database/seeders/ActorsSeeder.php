<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use Illuminate\Support\Facades\Hash;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cators = Actor::get();

        foreach($cators as $cator){
             $cator->update([
                'password' => Hash::make($cator->id_num),
             ]);
        }
    }
}
