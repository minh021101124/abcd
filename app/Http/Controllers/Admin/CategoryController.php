<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;


class CategoryController extends Controller
{
    protected $data = [];
    public function __construct(){}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $categories = Category::all();

       $categories = Category::orderBy('name','ASC')->get();
        return view('admin.category.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try{
            Category::create($request->all());
            return redirect() ->route('category.index')->with('success','Thêm mới thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Thêm mới thất bại');
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
    public function edit(Category $category)
    {
        // $categories = Category::all();
       
        $categories = Category::whereNull('parent_id')->get();
        
        return view('admin.category.edit', compact('category', 'categories'));
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        try{

            $category->update($request->all());

            return redirect() ->route('category.index')->with('success','Cập nhật thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Thêm mới thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{

            $category->delete();

            return redirect() ->route('category.index')->with('success','Xóa thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Thất bại');
        }
    }
    public function trash() {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.trash',compact('categories'));
    }
    public function restore($id){
        Category::withTrashed()->where('id',$id)->restore();
        //Category::withTrashed->where('id',$id)->restore();
        return redirect() ->route('category.index')->with('success','Khôi phục thành công');
    }
    public function forceDelete($id){
        Category::withTrashed()->where('id',$id)->forceDelete();
       
        return redirect() ->route('category.trash')->with('success','Thành công');
    }
    
}
