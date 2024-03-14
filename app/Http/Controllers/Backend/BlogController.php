<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Blog;
use Session;
use Image;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::get();
        $activePost = Blog::where('status', 1)->latest()->get();
        $inActivePost = Blog::where('status', 0)->latest()->get();
        return view('backend.blogs.blog_index',compact('posts','activePost','inActivePost'));
    }

    public function ActivePost(){
        Session::put('page', 'blogs.active');
        $activePost = Blog::where('status', 1)->latest()->get();
        return view('backend.blogs.blog_active', compact('activePost'));
    }

    public function InactivePost(){
        Session::put('page', 'blogs.inactive');
        $inActivePost = Blog::where('status', 0)->latest()->get();
        return view('backend.blogs.blog_inactive', compact('inActivePost'));
    }

    public function PostInactive($id){

        Blog::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function PostActive($id){

        Blog::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blogs.post_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = validator(request()->all(), [
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048', // Add validation for image file
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator);
    }

    if ($request->hasFile('photo')) {
        try {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Save the original image without resizing
            $imagePath = 'upload/blog_images/' . $name_gen;
            $image->move(public_path('upload/blog_images'), $name_gen);

            $imageName = $name_gen; // Store the image filename without the path

            $post = Blog::insertGetId([
                'title' => $request->title,
                'description' => $request->description,
                'post_slug' => strtolower(str_replace(' ','-',$request->title)),
                'meta_keywords' => $request->meta_keywords,
                'photo' => $imageName, // Store only the image filename in the database
                'status' => 1,
                'created_at' => now(),
            ]);

            $notification = [
                'message' => 'Admin Created Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('blogs')->with($notification);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during image processing
            return back()->withError('Image processing error: ' . $e->getMessage());
        }
    }

    // Handle the case where no image was uploaded
    return back()->withErrors(['photo' => 'Please upload an image']);
}

    public function show(Blog $blog)
    {
        //
    }

    public function edit($id){
        $post = Blog::find($id);
        return view('backend.blogs.post_edit',compact('id', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $id = $request->id;
    $post = Blog::find($id);
    $post->title = $request->title;
    $post->description = $request->description;
    $post->post_slug = strtolower(str_replace(' ', '-', $request->title));
    $post->meta_keywords = $request->meta_keywords;
    $post->status = 1;

    if ($request->file('photo')) {
        $image = $request->file('photo');

        // Generate a unique name for the image
        $filename = date('YmdHi') . '.' . $image->getClientOriginalExtension();

        // Save the original image to the storage directory
        $image->move(public_path('upload/blog_images'), $filename);

        // Delete the old image (if it exists)
        if (file_exists(public_path('upload/blog_images/' . $post->photo))) {
            @unlink(public_path('upload/blog_images/' . $post->photo));
        }

        $post->photo = $filename;
    }

    $post->save();

    $notification = array(
        'message' => 'Post Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('blogs')->with($notification);
}

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id){
        $post = Blog::findOrFail($id);
    
        // Get the file path for the image
        $imagePath = public_path('upload/blog_images/' . $post->photo);
    
        if (file_exists($imagePath)) {
            // Delete the image file
            unlink($imagePath);
        }
    
        // Delete the blog post
        Blog::findOrFail($id)->delete();
    
        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('blogs')->with($notification);
    }
}
