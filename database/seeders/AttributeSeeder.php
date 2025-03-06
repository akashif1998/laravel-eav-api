<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::create([
            'name' => 'department',
            'type' => 'text'
        ]);

        Attribute::create([
            'name' => 'start_date',
            'type' => 'date'
        ]);

        Attribute::create([
            'name' => 'end_date',
            'type' => 'date'
        ]);

        // Create more attributes...
    }
}