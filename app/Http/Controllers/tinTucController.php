<?php

namespace App\Http\Controllers;

use App\Models\hangMuc;
use App\Models\tinTuc;
use App\Models\HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class tinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blog = tinTuc::orderBy('maTinTuc', 'DESC')->where('trangThai', '1')->paginate(5);
        return view('admin.Blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $danhmuc = hangMuc::all();
        return view('admin.Blog.form')->with(compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $baiviet = new tinTuc();
        $baiviet->tieuDe = $data['tieuDe'];
        $baiviet->maHangMuc = $data['maHangMuc'];
        $baiviet->noiDung = $data['noiDung'];
        $baiviet->trangThai = $data['trangThai'];
        // them anh vao folder
        $get_image = $request->image;
        $path = 'admin/uploads/images';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $baiviet->hinhAnh = $new_image;

        $baiviet->save();

        //them bo suu tap
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $img) {
                $get_name_images = $img->getClientOriginalName();
                $name_images = current(explode('.', $get_name_images));
                $new_images = $name_images . rand(0, 999) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_images);
                $hinhanh = new HinhAnh();
                $hinhanh->hinhAnh = $new_images;
                $hinhanh->maTinTuc = $baiviet->maTinTuc;
                $hinhanh->save();
            }
        }

        return redirect()->back()->with('status', 'Thêm bài viết thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = tinTuc::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo ('delete');
        $bviet = tinTuc::find($id);
        $path = 'uploads/images/' . $bviet->image;
        if (file_exists($path)) {
            unlink($path);
        }
        tinTuc::find($id)->delete();

        $hinhanh = HinhAnh::where('maTinTuc', $id)->get();
        if ($hinhanh) {
            foreach ($hinhanh as $item) {
                $path = 'uploads/images/' . $item->hinhAnh;
                File::delete(public_path($path));
            }
            HinhAnh::where('maTinTuc', $id)->delete();
        }
        return redirect()->back();
    }
}
