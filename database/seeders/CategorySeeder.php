<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Modules\Category\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[];
        $timestamp = date('Y-m-d H:i:s');
        for ($i=0; $i < 10; $i++) { 
            $data[] = [
                'title' => Str::random(10),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }
        Category::insert($data);
    }
}
