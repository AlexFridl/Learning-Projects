<?php

use App\PartType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["Motor", "Gume", "Enterijer", "Ostalo"];
        foreach($types as $type){
            PartType::create(["name" => $type]);
        }
    }
}
