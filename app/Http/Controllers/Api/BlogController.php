<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog; // 1. นำเข้า Blog Model เพื่อให้เรียกใช้ Blog:: ได้
use App\Http\Resources\BlogResource; // 2. นำเข้า BlogResource เพื่อใช้จัดรูปแบบ Response

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return BlogResource::collection($blogs);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => true
        ]);

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(201);
    } 

  
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return new BlogResource($blog);
    }

   
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string'
        ]);

        $blog->update($request->all());
        return new BlogResource($blog);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'ลบบทความเรียบร้อยแล้ว'
        ], 200);
    }
}