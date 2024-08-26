<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogDetailController extends Controller
{
    public function index($id)
    {
        $postCategories = PostCategory::get();
        $post = Post::with('postCategory')->find($id);

        $this->countView($post);
        return view('frontend.pages.blog-detail', compact('post', 'postCategories'));
    }

    public function countView($post)
    {
        if(session()->has('viewed_posts')){
            $postIds = session('viewed_posts');

            if(!in_array($post->id, $postIds)){
                $postIds[] = $post->id;
                $post->increment('views');
            }
            session(['viewed_posts' => $postIds]);

        }else {
            session(['viewed_posts' => [$post->id]]);

            $post->increment('views');

        }
    }
}
