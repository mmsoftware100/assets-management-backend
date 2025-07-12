<?php

namespace Database\Seeders;

use App\Models\BankType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bankTypes = [
            ['id' => 1, 'name' => 'ရုံးချူပ်'],
            ['id' => 2, 'name' => 'တိုင်း'],
            ['id' => 3, 'name' => 'မြို့နယ်'],
        ];

        // Insert or update bank types into the database using the BankType model
        foreach ($bankTypes as $bankTypeData) {
            BankType::updateOrCreate(
                ['id' => $bankTypeData['id']], // Attributes to find by
                ['name' => $bankTypeData['name']] // Attributes to set or update
            );
        }
    }
}
