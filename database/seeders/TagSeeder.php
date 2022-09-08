<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'sports' => 'primary', // blue
            'relaxation' => 'secondary', // grey
            'fun' => 'warning', // yellow
            'nature' => 'success', // green
            'inspiration' => 'light', // white grey
            'friends' => 'info', // turquoise
            'love' => 'danger', // red
            'interest' => 'dark' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'title' => $key,
                    'color' => $value,
                ]
            );
            $tag->save();
        }
    }
}
