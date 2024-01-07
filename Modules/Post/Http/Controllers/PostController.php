<?php

namespace Modules\Post\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {   $query=Post::query();
        $searchTerm=$request->search;
        if($searchTerm){
            $query->where('name','LIKE','%'.$searchTerm.'%');
            $data['posts']=$query->get();
            return view('post::index',$data);
        }
        $posts=Post::latest()->paginate(20);

        return view('post::index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories=Category::all();
        return view('post::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' =>'required',
            'status' =>'required',
 //           'featured_image' =>'required_if:featured_image,true|mime:jpeg'
        ]);

        $imagePath='';
        if($request->has('image')&&$request->file('image')){
            $file=$request->file('image');
            $newName=time().'-'.rand(10,99999).'-'.$file->getClientOriginalExtension();
            $path=public_path('/uploads');
            $file->move($path,$newName);
            $imagePath=$newName;
        }
        $data=[
            'title'=>$request->title,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
            'slug'=>Str::slug($request->title),
            'created_by'=>auth()->guard('admin')->user()->id,
            'image'=>$imagePath,
        ];

        Post::insert($data);

       $request->session()->flash('success','Post Added Successfully');
       return  redirect()->route('post');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if(!$id){
           session()->flash('error','Post not found');
            return  redirect()->route('post');
        }
        $post=Post::find($id);
        $categories=Category::all();
        return view('post::edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if(!$id){
            session()->flash('error','Something is wrong');
            return redirect()->back();
        }
        $post=Post::find($id);
        if($post){
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' =>'required',
                'status' =>'required',
     //           'featured_image' =>'required_if:featured_image,true|mime:jpeg'
            ]);

            $imagePath='';
            if($request->has('image')&&$request->file('image')){
                $file=$request->file('image');
                $newName=time().'-'.rand(10,99999).'-'.$file->getClientOriginalExtension();
                $path=public_path('/uploads');
                $file->move($path,$newName);
                $imagePath=$newName;
            }
            $data=[
                'title'=>$request->title,
                'description'=>$request->description,
                'category_id'=>$request->category_id,
                'status'=>$request->status,
                'slug'=>Str::slug($request->title),
                'created_by'=>auth()->guard('admin')->user()->id,
                'image'=>$imagePath,
            ];
            $post->update($data);
            session()->flash('success','Post Updated Successfully');
            return redirect()->route('post');
        }
        session()->flash('error','Something is wrong');
        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if(!$id){
            session()->flash('error','Something is wrong');
            return redirect()->route('post');
        }
        $post=Post::find($id);
        if($post){
            $post->delete();
            session()->flash('success','Post deleted successfully');
            return redirect()->route('post');
        }
        session()->flash('error', 'Something went Wrong!!');
        return redirect()->route('post');
    }
}
