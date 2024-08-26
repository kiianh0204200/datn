<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreRequest;
use App\Http\Requests\Admin\Banner\UpdateRequest;
use App\Models\Banner;
use App\Helpers\Files;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BannerDataTable $bannerDataTable)
    {
        return $bannerDataTable->render('backend.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->safe()->all();
        $data['image'] = Files::upload($data['image'], 'banner');

        Banner::create([
            'header_title' => $data['header_title'] ?? null,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'sub_title' => $data['sub_title'] ?? null,
            'image' => $data['image'],
            'status' => $data['status'],
            'priority' => $data['priority'],
            'link' => $data['link'] ?? null,
        ]);

        toastr()->success(__('backend.Banner created successfully'));
        return redirect()->route('admin.banner.index');
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
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->safe()->all();

        $banner = Banner::findOrFail($id);
        if (isset($data['image']) && $data['image']) {
            $image = Files::upload($data['image'], 'banner');
        } else {
            $image = $banner->image;
        }
        $banner->update([
            'title' => $data['title'] ?? $banner->title,
            'sub_title' => $data['sub_title'] ?? $banner->sub_title,
            'status' => $data['status'] ?? $banner->status,
            'priority' => $data['priority'] ?? $banner->priority,
            'link' => $data['link'] ?? $banner->link,
            'image' => $image,
        ]);

        toastr()->success(__('backend.Banner updated successfully'));
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        toastr()->success(__('backend.Banner deleted successfully'));
        return redirect()->route('admin.banner.index');
    }
}
