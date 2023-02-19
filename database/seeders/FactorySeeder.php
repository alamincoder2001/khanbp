<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Factory;
class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factory::create([
            'image1' => 'no.image',
            'image2' => 'no.image',
            'image3' => 'no.image',
            'image4' => 'no.image',
        ]);
    }
}
