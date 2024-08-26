<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::paginate(10); // Số phần tử trên mỗi trang
        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Trả về view để tạo mới image
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'product_detail_id' => 'required|integer',
            'name_image' => 'required|string',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra hình ảnh
            'create_date' => 'required|date',
            'update_date' => 'required|date',
        ]);

        // Xử lý upload hình ảnh
        $imageName = time().'.'.$request->file('url')->extension();
        $request->file('url')->move(public_path('images'), $imageName);

        // Tạo mới image
        $image = new Image();
        $image->product_detail_id = $request->product_detail_id;
        $image->name_image = $request->name_image;
        $image->url = '/images/'.$imageName; // Lưu đường dẫn của hình ảnh
        $image->create_date = Carbon::now(new DateTimeZone('Asia/Ho_Chi_Minh'));
        $image->update_date = Carbon::now(new DateTimeZone('Asia/Ho_Chi_Minh'));
        $image->save();

        // Trả về view với hình ảnh mới được tải lên
        return redirect()->route('images.index')
            ->with('success', 'Image created successfully.')
            ->with('image', $image); // Truyền image vào view để hiển thị
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'product_detail_id' => 'required|integer',
            'name_image' => 'required|string',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra hình ảnh, cho phép nullable nếu không upload ảnh mới
        ]);

        // Lấy ảnh hiện tại
        $image = Image::findOrFail($id);

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('url')) {
            // Xóa ảnh cũ nếu có
            if (file_exists(public_path($image->url))) {
                unlink(public_path($image->url));
            }

            $imageName = time().'.'.$request->file('url')->extension();
            $request->file('url')->move(public_path('images'), $imageName);
            $image->url = '/images/'.$imageName; // Cập nhật đường dẫn của hình ảnh
        }

        // Cập nhật các thông tin khác của hình ảnh
        $image->product_detail_id = $request->product_detail_id;
        $image->name_image = $request->name_image;
        $image->create_date = Carbon::now(new DateTimeZone('Asia/Ho_Chi_Minh')); // Ngày hiện tại theo múi giờ Việt Nam
        $image->update_date = Carbon::now(new DateTimeZone('Asia/Ho_Chi_Minh')); // Ngày hiện tại theo múi giờ Việt Nam

        $image->save();

        return redirect()->route('images.index')
            ->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Xóa image
        $image = Image::findOrFail($id);
        $image->delete();

        return redirect()->route('images.index')
            ->with('success', 'Image deleted successfully.');
    }
}
