<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Land; // Import the Land model
use App\Models\Region; // Import Region model to get valid region IDs
use App\Models\Township; // Import Township model to get valid township IDs
use Faker\Factory as Faker;


class LandSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US'); // Using en_US for more general data, but can be 'my_MM' if specific Myanmar data is desired for some fields

        // Get existing region and township IDs
        $regionIds = Region::pluck('id')->toArray();
        $townshipIds = Township::pluck('id')->toArray();

        // Ensure there are regions and townships to associate with
        if (empty($regionIds)) {
            $this->command->warn('No regions found. Please run RegionSeeder first.');
            return;
        }
        if (empty($townshipIds)) {
            $this->command->warn('No townships found. Please run TownshipSeeder first.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            // Select random region and township IDs
            $randomRegionId = $faker->randomElement($regionIds);
            $randomTownshipId = $faker->randomElement($townshipIds);

            Land::create([
                'building_owner_name' => $faker->randomElement(['ဦးမောင်မောင်','ဦးကိုကို','ဦးအောင်မြင်','ဦးထွန်းအောင်','ဦးစိုးစံ','ဦးထွဋ်ထွဋ်','ဦးဇင်ဝင်း','ဦးနေမြင့်','ဦးလှိုင်ဦး','ဦးခင်မောင်','ဒေါ်မေမြင့်','ဒေါ်ချမ်းချမ်း','ဒေါ်စန်းစန်း','ဒေါ်ခင်စန်း','ဒေါ်မယ်မယ်','ဒေါ်ရတနာ','ဒေါ်နန်းဆွေ','ဒေါ်မိန်မိန်','ဒေါ်သက်သက်','ဒေါ်မီမီ']),
                'building_type_name' => $faker->randomElement(['စက်မှုဇုန်','လူနေအဆောက်အဦး','ဂိုဒေါင်','မြေကွက်၊ခြံကွက်' ]),
                'region_id' => $randomRegionId,
                'township_id' => $randomTownshipId,
                'address' => $faker->address(),
                'year_built' => $faker->date('Y-m-d', '2023-01-01'), // Date up to 2023
                'building_design_name' => $faker->randomElement(['ယာယီအဆောက်အဦး( Temporary Building )', 'သစ်သားအဆောက်အဦး ( Timber Building )', 'အုတ်အဆောက်အဦး( Brick Piller Building )', 'အုတ်ညှပ်အဆောက်အဦး( Brick Nogging Building)', 'သံကူကွန်ကရစ်အဆောက်အဦး( Reinforcing Concrete Building )','သံမဏိအဆောက်အဦး ( Steel Structure Building )']),
                //building_design_name = https://www.myanmarhouse.com.mm/blog/493/adaikasaaweta-uamyaoasamyaa
                'building_size' => $faker->numberBetween(500, 50000) . ' sq ft',
                'building_area' => $faker->randomFloat(2, 50, 5000) . ' sq m',
                'land_size' => $faker->randomFloat(2, 0.1, 10) . ' acres',
                'land_area' => $faker->randomFloat(2, 400, 40000) . ' sq m',
                'distributed_fund' => $faker->randomFloat(2, 1000000, 500000000), // Between 1 million and 500 million
                'price' => $faker->randomFloat(2, 5000000, 5000000000), // Between 5 million and 5 billion
                'is_currently_in_use' => $faker->boolean(90), // 90% chance of being in use
                'currently_in_use_note' => $faker->boolean(20) ? $faker->sentence() : null, // 20% chance of a note
                'type_details' => $faker->randomElement(['ဘိုးဘွားပိုင်မြေ (မြေပိုင်မြေ)', 'မြေငှားဂရန်မြေ', 'စကွာတာမြေ', 'လိုင်စင်မြေ','ပါမစ်မြေ','ဂရန်ရှိမြေပိုင်မြေ','အခွန်လွတ်သာသနာ့ ဂရန်မြေ','သိမ်ဂရန်မြေ']),
                // type_details = https://propertyseekermm.com/archives/517
                'is_grant_owned' => $faker->boolean(30), // 30% chance of being grant owned
                'grant_owned_note' => $faker->boolean(20) ? $faker->sentence() : null,
                'life_span' => $faker->numberBetween(30, 100),
                'is_ownership_changed' => $faker->boolean(15), // 15% chance of ownership changed
                'ownership_changed_note' => $faker->boolean(10) ? $faker->sentence() : null,
                'is_land_owned' => $faker->boolean(95), // 95% chance of land being owned
                'land_owned_note' => $faker->boolean(5) ? $faker->sentence() : null,
                'images' => $faker->boolean(70) ? 'land_image_' . $faker->unique()->numberBetween(1, 100) . '.jpg' : null,
                'documents' => $faker->boolean(60) ? 'land_document_' . $faker->unique()->numberBetween(1, 100) . '.pdf' : null,
            ]);
        }
    }
}
