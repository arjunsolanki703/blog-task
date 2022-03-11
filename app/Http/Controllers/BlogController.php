<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('user_id', Auth::user()->id)->get();
        return view('blog', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Blog::select('tags')->get();
        $tagArray = [];
        foreach ($tags as $key => $tag) {
            array_push($tagArray, $tag->tags);
        }
        $array = implode(',', $tagArray);
        $explode = array_unique(explode(',', $array));
        return view('form', compact('explode'));
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
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required'
        ]);
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;
        $blog->tags = implode(',', $request->tags);
        $blog->user_id = Auth::id();
        $blog->save();
        return redirect()->route('blog.create')
        ->with('success','Blog has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::with('user')->find($id);
        return view('details', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        $tags = Blog::select('tags')->get();
        $tagArray = [];
        foreach ($tags as $key => $tag) {
            array_push($tagArray, $tag->tags);
        }
        $array = implode(',', $tagArray);
        $explode = array_unique(explode(',', $array));
        return view('form', compact('blog', 'id', 'explode'));
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
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;
        $blog->tags = implode(',', $request->tags);
        $blog->user_id = Auth::id();
        $blog->update();
        return redirect()->route('blog.index')->with('success','Blog has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('success','Blog has been deleted successfully');
    }
}
