<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($path, $model)
    {
        include("csv-reader.php");
    }
}
