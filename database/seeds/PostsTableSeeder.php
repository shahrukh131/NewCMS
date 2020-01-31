<?php

use Illuminate\Database\Seeder;
use App\Catagory;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catagory1 = Catagory::create([
            'name' => 'news'
        ]);
        $catagory2 = Catagory::create([
            'name' => 'Marketing'
        ]);
        $catagory3 = Catagory::create([
            'name' => 'Design'
        ]);

        $author1 = App\User::create([
            'name' => 'Akib',
            'email' => 'akib@gmail.com',
            'password' => Hash::make('password')
        ]);

        $author2 = App\User::create([
            'name' => 'Shahrukh',
            'email' => 'Shahrukh@gmail.com',
            'password' => Hash::make('password')
        ]);



        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            'content' => 'asdasdhasdhasd',
            'catagory_id' => $catagory1->id,
            'image' => 'storage/images/1.jpg',
            'user_id' => $author1->id
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            'content' => 'asdasdhasdhasddasdasddfdsfsdfsdf',
            'catagory_id' => $catagory2->id,
            'image' => 'storage/images/2.jpg'
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            'content' => 'asdasdhasdhasddasdasddfdsfsdfsdf',
            'catagory_id' => $catagory3->id,
            'image' => 'storage/images/3.jpg'
        ]);

        $post4 = $author2->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            'content' => 'asdasdhasdhasddasdasddfdsfsdfsdf',
            'catagory_id' => $catagory2->id,
            'image' => 'storage/images/4.jpg'
        ]);

        $tag1 = Tag::create([
            'name' => 'job'
        ]);

        $tag2 = Tag::create([
            'name' => 'customers'
        ]);
        $tag3 = Tag::create([
            'name' => 'record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag1->id, $tag2->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
