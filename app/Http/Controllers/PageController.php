<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PageController extends Controller
{
	public function homepage ()
	{
		$categories = Category::all();
		$posts = Post::orderby('id', 'desc')->limit(3)->get();

    	return view('client.home', compact('posts', 'categories'));
	}
}
