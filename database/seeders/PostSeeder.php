<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
// use DateTime;　

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
{
        DB::table('posts')->insert([
                'title' => '隠れスポット',
                'body' => 'いいねしたテストデータ',
                'category_id'=> '1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]); 
         DB::table('posts')->insert([
                'title' => '隠れスポット2',
                'body' => 'いいねしてないテストデータ',
                'category_id'=> '1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
    
}
