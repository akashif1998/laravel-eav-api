<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timesheet;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Timesheet::create([
            'user_id' => 1,          
            'project_id' => 1,      // Replace with an existing project ID
            'task_name' => 'Development',
            'date' => '2024-03-05',
            'hours' => 8
        ]);

        Timesheet::create([
            'user_id' => 1,          
            'project_id' => 2,      
            'task_name' => 'Testing',
            'date' => '2024-03-05',
            'hours' => 4
        ]);


    }
}
