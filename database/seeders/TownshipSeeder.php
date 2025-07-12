<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $townships = [
            ['id'=>1, 'name' => 'ဉတ္တရသီရိမြို့နယ်', 'region_id' => 1],
            ['id'=>2, 'name' => 'ဆူးလေမြို့နယ်', 'region_id' => 2],
            ['id'=>3, 'name' => 'ပြည်ကြီးတံခွန်မြို့နယ်', 'region_id' => 3],
        ];

        // insert regions into the database
        // Insert or update regions into the database using the Region model
        // Insert or update townships into the database using the Township model
        foreach ($townships as $townshipData) {
            Township::updateOrCreate(
                ['id' => $townshipData['id']], // Attributes to find by
                [
                    'name' => $townshipData['name'],
                    'region_id' => $townshipData['region_id'] // Attributes to set or update
                ]
            );
        }
    }
}
