<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    private $modelCategory;
    public function __construct(\App\Models\Category $modelCategory)
    {
        $this->modelCategory = $modelCategory;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->modelCategory->create([
            'slug' => 'makanan-ringan',
            'name' => 'Makanan Ringan'
        ]);
        $this->modelCategory->create([
            'slug' => 'makanan-berat',
            'name' => 'Makanan Berat',
        ]);
        $this->modelCategory->create([
            'slug' => 'minuman',
            'name' => 'minuman',
        ]);
    }
}
