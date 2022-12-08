<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['blogs'] = Blog::all();
        return [
            "status" => 1,
            "data" => $data
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validateBlog($request);
        $this->storeBlogs(new Blog, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data['data'] = Blog::findOrFail($id);
        return([
            'status' => 1,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validateBlog($request);
        $this->storeBlogs(Blog::findOrFail($id), $request);
    }

    public function validateBlog($data) {
        $data->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
    }

    public function storeBlogs($blogs, $data) {
        $blogs->title = $data->title;
        $blogs->body  = $data->body;
        $blogs->save();

        return response()->json($blogs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $blog = Blog::findOrFail($id);
        if(!empty($blog)) {
            $blog->delete();
        } else {
            return response()->json('No Data Found');
        }

        return response()->json('Data Deleted');
    }
}
