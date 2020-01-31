<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome')
            ->with('catagories', Catagory::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::all());
    }
}
