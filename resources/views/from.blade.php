@extends('layouts.app')

@section('title', 'เขียนบทความ')

@section('content')

<div class="container">

    <h2 class="text-center py-3">
        เขียนบทความ
    </h2>

    <form method="POST"
          action="{{ route('author.blog.store') }}">

        @csrf

        <!-- ชื่อบทความ -->
        <div class="mb-3">

            <label for="title" class="form-label">
                ชื่อบทความ
            </label>

            <input type="text"
                   id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   name="title"
                   value="{{ old('title') }}"
                   maxlength="150"
                   required>

            @error('title')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- เนื้อหา -->
        <div class="mb-3">

            <label for="content" class="form-label">
                เนื้อหา
            </label>

            <textarea
                name="content"
                id="content"
                rows="5"
                class="form-control @error('content') is-invalid @enderror"
            >{{ old('content') }}</textarea>

            @error('content')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- ปุ่ม -->
        <button type="submit"
                class="btn btn-primary mt-3">
            บันทึก
        </button>

        <a href="{{ route('author.blog.manage') }}"
           class="btn btn-secondary mt-3">
            บทความทั้งหมด
        </a>

    </form>

</div>

@endsection