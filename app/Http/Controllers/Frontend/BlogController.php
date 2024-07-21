<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $postCategories = PostCategory::get();
        $posts = Post::with('postCategory')->paginate(10);
        $posts = Post::query()
            ->when($request->query('category'), function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($request->query('title'), function ($query, $title) {
                $query->where('title', 'like', "%{$title}%");
            })
            ->paginate(10);
        ;
        $title = $request->query('title');

        return view('frontend.pages.blog', compact('postCategories', 'posts','title'));
    }
}
