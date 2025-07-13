<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['id'=>1, 'name' => 'နေပြည်တော်'],
            ['id'=>2,'name' => 'ရန်ကုန်'],
            ['id'=>3,'name' => 'မန္တလေး'],
            ['id'=>4,'name' => 'တောင်ကြီး'],
        ];

        // insert regions into the database
        // Insert or update regions into the database using the Region model
        foreach ($regions as $regionData) {
            Region::updateOrCreate(
                ['id' => $regionData['id']], // Find by 'id'
                ['name' => $regionData['name']] // Update or create with 'name'
            );
        }
    }
}
