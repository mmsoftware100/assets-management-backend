<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankType;
use App\Models\Region;
use App\Models\Township;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $banks = [
        //     [
        //         'id' => 1,
        //         'name' => 'First Naypyidaw Bank Branch',
        //         'region_id' => 1, // Associated with 'နေပြည်တော်' region
        //         'township_id' => 1, // Associated with 'ဉတ္တရသီရိမြို့နယ်' township
        //         'bank_type_id' => 1, // Assuming a bank type with ID 1 exists
        //         'latitude' => 19.7633,
        //         'longitude' => 96.0785,
        //         'address' => 'ဉတ္တရသီရိမြို့နယ်၊ နေပြည်တော်',
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Sule Bank Branch',
        //         'region_id' => 2, // Associated with 'ရန်ကုန်' region
        //         'township_id' => 2, // Associated with 'ဆူးလေမြို့နယ်' township
        //         'bank_type_id' => 2, // Assuming a bank type with ID 1 exists
        //         'latitude' => 16.7770,
        //         'longitude' => 96.1593,
        //         'address' => 'ဆူးလေမြို့နယ်၊ ရန်ကုန်',
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Pyigyitagon Bank Branch',
        //         'region_id' => 3, // Associated with 'မန္တလေး' region
        //         'township_id' => 3, // Associated with 'ပြည်ကြီးတံခွန်မြို့နယ်' township
        //         'bank_type_id' => 3, // Assuming a bank type with ID 1 exists
        //         'latitude' => 21.9213,
        //         'longitude' => 96.1130,
        //         'address' => 'ပြည်ကြီးတံခွန်မြို့နယ်၊ မန္တလေး',
        //     ],
        // ];

       
        // Get all townships and bank types
        $townships = Township::all();

        // Main Store
        // ဘဏ်ချူပ်

        Bank::create([
            'id' => 1,
            'name' =>  'Main Store',
            'region_id' => 1,
            'township_id' => 1,
            'bank_type_id' => 1,
            'address' => 'ပင်မဂိုဒေါင်ရုံ လိပ်စာ။',
            'latitude' => null, // You can add actual latitude/longitude if needed
            'longitude' => null, // You can add actual latitude/longitude if needed
        ]);
        Bank::create([
            'id' => 2,
            'name' =>  'မြန်မာ့စီးပွားရေးဘဏ် ရုံးချူပ်',
            'region_id' => 1,
            'township_id' => 1,
            'bank_type_id' => 1,
            'address' => 'နေပြည်တော် ပြည်ထောင်စုနယ်မြေ။',
            'latitude' => null, // You can add actual latitude/longitude if needed
            'longitude' => null, // You can add actual latitude/longitude if needed
        ]);

        // Seed one bank for each township
        foreach ($townships as $township) {
            // Get the region associated with the current township
            $region = Region::find($township->region_id);

            // Get a random bank type
            // $randomBankType = $bankTypes->random();

            DB::table('banks')->insert([
                'name' =>  $township->name . ' ဘဏ်ခွဲ',
                'region_id' => $region->id,
                'township_id' => $township->id,
                'bank_type_id' => 3,
                'address' => 'အမှတ် (၁၂၅)၊  ' . $township->name . '၊ ' . $region->name,
                'latitude' => null, // You can add actual latitude/longitude if needed
                'longitude' => null, // You can add actual latitude/longitude if needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

 


        // Insert or update banks into the database using the Bank model
        // foreach ($banks as $bankData) {
        //     Bank::updateOrCreate(
        //         ['id' => $bankData['id']], // Attributes to find by
        //         [
        //             'name' => $bankData['name'],
        //             'region_id' => $bankData['region_id'],
        //             'township_id' => $bankData['township_id'],
        //             'bank_type_id' => $bankData['bank_type_id'],
        //             'latitude' => $bankData['latitude'],
        //             'longitude' => $bankData['longitude'],
        //             'address' => $bankData['address'],
        //         ]
        //     );
        // }
    }
}
