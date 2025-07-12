<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset; // Import the Asset model
use App\Models\Bank; // Import the Bank model to get valid bank_ids
use App\Models\Township; // Import Township model to get valid township names
use App\Models\Region; // Import Region model to get valid region names
use Faker\Factory as Faker;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get existing bank IDs, township names, and region names
        $bankIds = Bank::pluck('id')->toArray();
        $townshipNames = Township::pluck('name')->toArray();
        $regionNames = Region::pluck('name')->toArray();

        // Ensure there are banks, townships, and regions to associate with
        if (empty($bankIds)) {
            $this->command->info('No banks found. Please run BankSeeder first.');
            return;
        }
        if (empty($townshipNames)) {
            $this->command->info('No townships found. Please run TownshipSeeder first.');
            return;
        }
        if (empty($regionNames)) {
            $this->command->info('No regions found. Please run RegionSeeder first.');
            return;
        }


        for ($i = 0; $i < 20; $i++) {
            Asset::create([
                'bank_id' => $faker->randomElement($bankIds),
                'ministry_name' => $faker->randomElement(['Ministry of Finance', 'Ministry of Planning', 'Ministry of Education', 'Ministry of Health', null]),
                'department_name' => $faker->randomElement(['General Administration Department', 'Revenue Department', 'IT Department', 'Human Resources', null]),
                'machine_name' => $faker->randomElement(['Server', 'Desktop PC', 'Laptop', 'Printer', 'Network Switch', 'UPS']),
                'department_no' => $faker->unique()->regexify('[A-Z]{3}-[0-9]{3}'), // e.g., 'NEC-57'
                'brand_name' => $faker->randomElement(['HPE', 'Dell', 'HP', 'Lenovo', 'Cisco', 'Epson', 'APC']),
                'make_name' => $faker->randomElement(['Malaysia', 'China', 'USA', 'Vietnam', 'Singapore']),
                'model_name' => $faker->randomElement(['B1460c-Gen 10', 'OptiPlex 7000', 'ThinkPad X1 Carbon', 'LaserJet Pro M404n', 'Catalyst 9300', 'Smart-UPS SMT1500']),
                'mother_board_name' => $faker->randomElement(['Intel Z590', 'AMD B550', 'Gigabyte B450', 'ASUS ROG', 'MSI Pro', null]),
                'memory_name' => $faker->randomElement(['8GB DDR4', '16GB DDR4', '32GB DDR4', '64GB DDR5']),
                'storage_device_name' => $faker->randomElement(['256GB SSD', '512GB SSD', '1TB SSD', '2TB HDD', '4TB HDD']),
                'monitor_name' => $faker->randomElement(['Dell 24"', 'HP 27"', 'LG UltraWide', 'Samsung Curved', null]),
                'multi_media_name' => $faker->randomElement(['Webcam C920', 'JBL Speakers', 'Headset', null]),
                'number_name' => (string) $faker->numberBetween(1, 10), // Convert to string
                'price_name' => number_format($faker->randomFloat(2, 500000, 20000000), 0, '.', ','), // Format with commas
                'condition_name' => $faker->randomElement(['Serviceable', 'Needs Repair', 'New', 'Damaged']),
                'budget_year_name' => $faker->randomElement(['2023-2024', '2024-2025', '2025-2026']),
                'location_township_name' => $faker->randomElement($townshipNames),
                'location_region_name' => $faker->randomElement($regionNames),
                'received_by_name' => $faker->name(),
                'remark_name' => $faker->sentence(),
            ]);
        }
    }
}
