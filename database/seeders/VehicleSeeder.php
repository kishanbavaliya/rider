<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'vehicle_type' => 'car',
                'name' => 'Go Premium 5-hr',
                'brand' => 'Toyota',
                'model' => 'Innova',
                'description' => '300 km tak ki savvari',
                'price' => 1368,
                // 'image' => '',
            ],
            [
                'vehicle_type' => 'car',
                'name' => 'Go',
                'brand' => 'Maruti',
                'model' => 'Swift',
                'description' => '300 km tak ki savvari',
                'price' => 1368,
                // 'image' => 'go.png',
            ],
            [
                'vehicle_type' => 'car',
                'name' => 'Go Mini',
                'brand' => 'Hyundai',
                'model' => 'i10',
                'description' => '300 km tak ki savvari',
                'price' => 1368,
                // 'image' => 'go_mini.png',
            ],
            [
                'vehicle_type' => 'bike',
                'name' => 'Bike',
                'brand' => 'Hero',
                'model' => 'Splendor',
                'description' => '300 km tak ki savvari',
                'price' => 1368,
                // 'image' => 'bike.png',
            ]
        ];

        foreach ($vehicles as $vehicle) {
            VehicleType::create($vehicle);
        }
    }
}
