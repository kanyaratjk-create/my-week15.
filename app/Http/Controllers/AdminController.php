<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blogs()
    {
        $blogs = Blog::paginate(5);

        return view('blog2', compact('blogs'));
    }

    public function blog2()
    {
        return $this->blogs();
    }

    function abouts()
    {
        $name = "kanyarat Juiklang";
        $data = "26 June 2004";
        return view('abouts', compact('name', 'data'));
    }

    function create()
    {
        return view("form");
    }

    function insert(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
            ],
            [
                'title.required' => 'กรุณาระบุชื่อบทความ',
                'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณาระบุเนื้อหาบทความ'
            ]
        );
        $data = [
            "title" => $request->input("title"),
            "content" => $request->input("content"),
        ];

        Blog::insert($data);

        return redirect('/blog2');
    }

    function delete($id)
    {
        Blog::find($id)->delete();

        return redirect()->back();
    }

    function change($id)
    {
        $blog = Blog::find($id);
        $data = [
            'status' => $blog->status
        ];
        if ($blog->status == 0) {
            $data = ['status' => 1];
        } else {
            $data = ['status' => 0];
        }
        Blog::find($id)->update($data);
        return redirect()->back();
    }

    function edit($id)
    {
        $blog = Blog::find($id);
        return view("edit", compact('blog'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ], [
            'title.required' => 'กรุณาใส่ชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณาใส่เนื้อหา',
        ]);
        $data = [
            'title' => $request->input("title"),
            'content' => $request->input("content"),
        ];
        Blog::find($id)->update($data);
        return redirect('/blog2');
    }
}