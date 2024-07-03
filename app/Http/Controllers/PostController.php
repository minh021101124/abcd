<?php

namespace App\Http\Controllers;

use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Product::all();
        return view('admin.prod.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
    
        return view('admin.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile("photo")){
            $file=$request->file("photo");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("photo/"),$imageName);

            $post =new Product([
                "name" =>$request->name,
                "price"=>$request->price,
                "sale_price"=>$request->sale_price,
                "category_id" =>$request->category_id,
                "description"=>$request->description,
                "image" =>$imageName,
            ]);
           $post->save();
        }

            if($request->hasFile("photo")){
                $files=$request->file("photo");
                foreach($files as $file){
                    $imageName=time().'_'.$file->getClientOriginalName();
                    $request['product_id']=$post->id;
                    $request['image']=$imageName;
                    $file->move(\public_path("/photo"),$imageName);
                    ImgProduct::create($request->all());

                }
            }

            return redirect("/a");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $posts=Product::findOrFail($id);
        return view('admin.prod.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
     $post=Product::findOrFail($id);
     if($request->hasFile("photo")){
         if (File::exists("photo/".$post->cover)) {
             File::delete("photo/".$post->cover);
         }
         $file=$request->file("photo");
         $post->photo=time()."_".$file->getClientOriginalName();
         $file->move(\public_path("/photo"),$post->cover);
         $request['photo']=$post->photo;
     }

        $post->update([
            "name" =>$request->name,
                "price"=>$request->price,
                "sale_price"=>$request->sale_price,
                "category_id" =>$request->category_id,
                "description"=>$request->description,
                "image" =>$imageName,
        ]);

        if($request->hasFile("images")){
            $files=$request->file("images");
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request["category_id"]=$id;
                $request["image"]=$imageName;
                $file->move(\public_path("images"),$imageName);
                ImgProduct::create($request->all());

            }
        }

        return redirect("/a");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $posts=Post::findOrFail($id);

         if (File::exists("cover/".$posts->cover)) {
             File::delete("cover/".$posts->cover);
         }
         $images=Image::where("post_id",$posts->id)->get();
         foreach($images as $image){
         if (File::exists("images/".$image->image)) {
            File::delete("images/".$image->image);
        }
         }
         $posts->delete();
         return back();


    }

    public function deleteimage($id){
        $images=ImgProduct::findOrFail($id);
        if (File::exists("images/".$images->image)) {
           File::delete("images/".$images->image);
       }

       ImgProduct::find($id)->delete();
       return back();
   }

   public function deletecover($id){
    $cover=Post::findOrFail($id)->cover;
    if (File::exists("cover/".$cover)) {
       File::delete("cover/".$cover);
   }
   return back();
}


}