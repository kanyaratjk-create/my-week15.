<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * กำหนดสิทธิ์การเข้าใช้งาน
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'manage',
            'create',
            'store',
            'edit',
            'update',
            'delete',
            'changeStatus'
        ]);
    }

    /**
     * หน้าแรก
     * แสดงเฉพาะบทความที่เผยแพร่แล้ว
     */
    public function index()
    {
        $blogs = Blog::orderByDesc('id')
            ->where(function ($q) {
                $q->where('status', true)
                  ->orWhere('status', '1')
                  ->orWhere('status', 'published');
            })
            ->get();

        return view('index', compact('blogs'));
    }

  
    public function detail($id)
    {
        $blogs = Blog::findOrFail($id);

        $blog = $blogs;

        return view('detail', compact('blogs', 'blog'));
    }

  
    public function manage()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('blog2', compact('blogs'));
    }

   
    public function create()
    {
        return view('from');
    }

 
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูล
        $validated = $request->validate(
            [
                'title'   => 'required|string|max:150',
                'content' => 'required|string|min:10',
            ],
            [
                'title.required'   => 'กรุณากรอกชื่อบทความ',
                'title.max'        => 'ชื่อบทความต้องไม่เกิน 150 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหา',
                'content.min'      => 'เนื้อหาต้องมีอย่างน้อย 10 ตัวอักษร',
            ]
        );

        // บันทึกบทความ
        Blog::create([
            'title'   => $validated['title'],
            'content' => $validated['content'],
            'status'  => true,
        ]);

        // กลับไปหน้าแรก
        return redirect('/')
            ->with('success', 'บันทึกบทความเรียบร้อยแล้ว');
    }

    /**
     * หน้าแก้ไขบทความ
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('edit', compact('blog'));
    }

    /**
     * อัปเดตบทความ
     */
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูล
        $validated = $request->validate(
            [
                'title'   => 'required|string|max:150',
                'content' => 'required|string',
            ],
            [
                'title.required'   => 'กรุณาใส่ชื่อบทความ',
                'title.max'        => 'ชื่อบทความต้องไม่เกิน 150 ตัวอักษร',
                'content.required' => 'กรุณาใส่เนื้อหา',
            ]
        );

        // ค้นหาบทความ
        $blog = Blog::findOrFail($id);

        // อัปเดตข้อมูล
        $blog->update([
            'title'   => $validated['title'],
            'content' => $validated['content'],
        ]);

        // กลับหน้าจัดการ
        return redirect()
            ->route('author.blog.manage')
            ->with('success', 'แก้ไขบทความเรียบร้อยแล้ว');
    }

    /**
     * ลบบทความ
     */
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return redirect()
            ->back()
            ->with('success', 'ลบบทความเรียบร้อยแล้ว');
    }

    /**
     * เปลี่ยนสถานะบทความ
     */
    public function changeStatus($id)
    {
        $blog = Blog::findOrFail($id);

        // สลับสถานะ true <-> false
        $blog->status = !$blog->status;

        $blog->save();

        return redirect()
            ->back()
            ->with('success', 'เปลี่ยนสถานะบทความเรียบร้อยแล้ว');
    }
}