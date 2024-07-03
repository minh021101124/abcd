<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imag = Banner::all();
        return view('admin.banner.index',compact('imag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.image');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        try {
            if ($request->hasFile("cover")) {
                $file = $request->file("cover");
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("imagebanner"), $imageName);
                $image = new Banner([
                    "cover" => $imageName,
                ]);
                $image->save();
            }
            return redirect()->route('banner.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       //
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
    }

    public function deleteimage($id){
        $image = Banner::findOrFail($id);
    
        // Xóa ảnh từ thư mục
        if (File::exists("imagebanner/" . $image->cover)) {
            File::delete("imagebanner/" . $image->cover);
        }
    
        // Xóa dữ liệu ảnh từ CSDL
        $image->delete();
    
        return back()->with('success', 'Ảnh đã được xóa thành công');
    }
}
