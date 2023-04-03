<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts=[
            [
                "title"=>"Oliver Twist",
                "context"=>"A poor Boy",
                "min_to_read"=>7,
                "is_published"=>false,
                "image_path"=>"Empty"
            ],
            [
                "title"=>"Great Expectattions",
                "context"=>"Pip",
                "min_to_read"=>10,
                "is_published"=>false,
                "image_path"=>"Empty"
            ]
        ];
        //loop through the array

        foreach($posts as $key => $value){
            //call post model
            Post::create($value);

        }
    }
}
