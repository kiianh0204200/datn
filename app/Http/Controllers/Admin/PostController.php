<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostDataTable;
use App\Helpers\Files;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostDataTable $table)
    {
        return $table->render('backend.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::get();
        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();

        $data['user_id'] = auth()->id();
        $data['thumbnail'] = Files::upload($data['thumbnail'], 'posts');

        $data['slug'] = $this->checkSlug($data['title']);

        Post::create([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'content' => $data['description'] ?? null,
            'is_published' => $data['status'],
            'excerpt' => $data['excerpt'],
            'thumbnail' => $data['thumbnail'],
            'slug' => $data['slug'],
            'author_id' => $data['user_id'],
        ]);

        toastr()->success(__('backend.Post created successfully'));
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::get();
        return view('backend.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();
        $post = Post::findOrFail($id);
        if (isset($data['thumbnail']) && $data['thumbnail']) {
            $thumbnail = Files::upload($data['thumbnail'], 'products');
        } else {
            $thumbnail = $post->thumbnail;
        }
        $data['slug'] = $this->checkSlug($data['title']);

        $post->update([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'content' => $data['description'] ?? null,
            'is_published' => $data['status'],
            'excerpt' => $data['excerpt'],
            'thumbnail' => $thumbnail,
            'slug' => $data['slug'],
        ]);

        toastr()->success(__('backend.Post updated successfully'));
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        toastr()->success(__('backend.Post deleted successfully'));
        return redirect()->route('admin.post.index');
    }

    protected function checkSlug($name)
    {
        $checkSlug = Post::where('slug', Str::slug($name))->exists();
        if ($checkSlug) {
            $slug = Str::slug($name) . '-' . uniqid();
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
}
