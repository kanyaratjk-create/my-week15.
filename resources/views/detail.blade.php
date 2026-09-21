@extends('layouts.app')

@section('title', $blogs->title)

@section('content')

<div class="container page-container-md">

    <div class="mb-4">

        <h1 class="page-heading">
            {{ $blogs->title }}
        </h1>

    </div>

    <hr>

  
    <div class="blog-content mt-4">
        {!! $blogs->content !!}
    </div>

  
    <div class="mt-4">

        <a href="{{ url('/') }}" class="btn btn-secondary">
            กลับหน้าหลัก
        </a>

    </div>

</div>

@endsection