<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MenuItem::create([
            'label' => 'Blogs',
            'menu_id' => 1,
            'order' => 0,
            'source' => 'custom',
            'url' => '/blog',
            'status' => 1,
            'target' => '_self'
        ]);
    }
}
