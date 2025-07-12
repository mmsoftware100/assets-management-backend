<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'id' => 1,
                'name' => 'First Naypyidaw Bank Branch',
                'region_id' => 1, // Associated with 'နေပြည်တော်' region
                'township_id' => 1, // Associated with 'ဉတ္တရသီရိမြို့နယ်' township
                'bank_type_id' => 1, // Assuming a bank type with ID 1 exists
                'latitude' => 19.7633,
                'longitude' => 96.0785,
                'address' => 'ဉတ္တရသီရိမြို့နယ်၊ နေပြည်တော်',
            ],
            [
                'id' => 2,
                'name' => 'Sule Bank Branch',
                'region_id' => 2, // Associated with 'ရန်ကုန်' region
                'township_id' => 2, // Associated with 'ဆူးလေမြို့နယ်' township
                'bank_type_id' => 2, // Assuming a bank type with ID 1 exists
                'latitude' => 16.7770,
                'longitude' => 96.1593,
                'address' => 'ဆူးလေမြို့နယ်၊ ရန်ကုန်',
            ],
            [
                'id' => 3,
                'name' => 'Pyigyitagon Bank Branch',
                'region_id' => 3, // Associated with 'မန္တလေး' region
                'township_id' => 3, // Associated with 'ပြည်ကြီးတံခွန်မြို့နယ်' township
                'bank_type_id' => 3, // Assuming a bank type with ID 1 exists
                'latitude' => 21.9213,
                'longitude' => 96.1130,
                'address' => 'ပြည်ကြီးတံခွန်မြို့နယ်၊ မန္တလေး',
            ],
        ];

        // Insert or update banks into the database using the Bank model
        foreach ($banks as $bankData) {
            Bank::updateOrCreate(
                ['id' => $bankData['id']], // Attributes to find by
                [
                    'name' => $bankData['name'],
                    'region_id' => $bankData['region_id'],
                    'township_id' => $bankData['township_id'],
                    'bank_type_id' => $bankData['bank_type_id'],
                    'latitude' => $bankData['latitude'],
                    'longitude' => $bankData['longitude'],
                    'address' => $bankData['address'],
                ]
            );
        }
    }
}
