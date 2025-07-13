<?php

namespace Database\Seeders;

use App\Models\Region;
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
        
        // Get region IDs for linking townships
        $yangonRegion = Region::where('name', 'ရန်ကုန်')->first();
        $naypyidawRegion = Region::where('name', 'နေပြည်တော်')->first();
        $mandalayRegion = Region::where('name', 'မန္တလေး')->first();
        $taunggyiRegion = Region::where('name', 'တောင်ကြီး')->first();

        // Define townships with their respective region IDs
        $townships = [
            // Yangon Region
            ['id'=> 1, 'name' => 'လှိုင်', 'region_id' => $yangonRegion->id], // Hlaing
            ['id'=> 2,'name' => 'မရမ်းကုန်း', 'region_id' => $yangonRegion->id], // Mayangone

            // Naypyidaw Region
            ['id'=> 3,'name' => 'ပျဉ်းမနား', 'region_id' => $naypyidawRegion->id], // Pyinmana
            ['id'=> 4,'name' => 'ဇမ္ဗူသီရိ', 'region_id' => $naypyidawRegion->id], // Zabuthiri

            // Mandalay Region
            ['id'=> 5,'name' => 'ချမ်းအေးသာစံ', 'region_id' => $mandalayRegion->id], // Chanayethazan
            ['id'=> 6,'name' => 'အောင်မြေသာစံ', 'region_id' => $mandalayRegion->id], // Aungmyaythazan

            // Taunggyi Region
            ['id'=> 7,'name' => 'အေးသာယာ', 'region_id' => $taunggyiRegion->id], // Ayetharyar
            ['id'=> 8,'name' => 'ညောင်ရွှေ', 'region_id' => $taunggyiRegion->id], // Nyaungshwe
        ];

        // $townships = [
        //     ['id'=>1, 'name' => 'ဉတ္တရသီရိမြို့နယ်', 'region_id' => 1],
        //     ['id'=>2, 'name' => 'ဆူးလေမြို့နယ်', 'region_id' => 2],
        //     ['id'=>3, 'name' => 'ပြည်ကြီးတံခွန်မြို့နယ်', 'region_id' => 3],
        // ];

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
