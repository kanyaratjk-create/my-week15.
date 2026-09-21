@extends('layouts.app')

@section('title', 'บทความล่าสุด')

@section('content')
    <div class="container py-5" style="margin-top: 90px;">
        <h2>บทความล่าสุด</h2>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse ($blogs as $item)
            <div class="mb-4">
                <a href="#" class="d-block mb-1" style="text-decoration:underline;">อ่านเพิ่มเติม</a>
                <h3>{{ $item->title }}</h3>
                <p class="text-muted">{{ $item->content }}</p>
            </div>
        @empty
            <p>ยังไม่มีบทความ</p>
        @endforelse

        <div class="d-flex justify-content-center mt-5">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection