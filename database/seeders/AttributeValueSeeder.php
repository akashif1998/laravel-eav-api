<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use App\Models\Project; // Import the Project model

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeValue::create([
            'attribute_id' => 1,  // ID of the 'department' attribute
            'entity_id' => 1,    // ID of the project
            'value' => 'Technology'
        ]);

        AttributeValue::create([
            'attribute_id' => 2,  // ID of the 'start_date' attribute
            'entity_id' => 1,    // ID of the project
            'value' => '2024-03-01'
        ]);

        // Assign more attribute values to projects...
    }
}