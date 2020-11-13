<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = [
            ['gender' => 'Homme', 'created_at' => Now(), 'updated_at' => Now()],
            ['gender' => 'Femme', 'created_at' => Now(), 'updated_at' => Now()],
            ['gender' => 'Non binaire', 'created_at' => Now(), 'updated_at' => Now()],
        ];
        Gender::insert($gender);
    }
}
