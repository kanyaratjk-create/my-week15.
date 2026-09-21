<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <meta name="csrf-token" content="{{ csrf_token() }}">

   
    <title>@yield('title', 'kanyarat Juiklang')</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

   
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">

  
    @vite([
        'resources/sass/app.scss',
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body>

    <div id="app">

     
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <!-- Website Name -->
                <a class="navbar-brand"
                   href="{{ url('/') }}">
                    kanyarat Juiklang
                </a>

                <!-- Mobile Navbar Button -->
                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse"
                     id="navbarSupportedContent">

                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">

                        <!-- =================================
                             GUEST
                        ================================== -->
                        @guest

                            <!-- Login -->
                            @if (Route::has('login'))

                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('login') }}">
                                        เข้าสู่ระบบ
                                    </a>
                                </li>

                            @endif

                            <!-- Register -->
                            @if (Route::has('register'))

                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('register') }}">
                                        สมัครสมาชิก
                                    </a>
                                </li>

                            @endif

                        <!-- =================================
                             LOGIN USER
                        ================================== -->
                        @else

                            <li class="nav-item dropdown">

                                <!-- User -->
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   v-pre>

                                    สวัสดี, {{ Auth::user()->name }}

                                </a>

                                <!-- Dropdown -->
                                <div class="dropdown-menu dropdown-menu-end"
                                     aria-labelledby="navbarDropdown">

                                    <!-- Create Blog -->
                                    @if (Route::has('author.blog.create'))

                                        <a class="dropdown-item"
                                           href="{{ route('author.blog.create') }}">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            เขียนบทความ
                                        </a>

                                    @endif

                                    <!-- All Blogs -->
                                    @if (Route::has('blog2'))

                                        <a class="dropdown-item"
                                           href="{{ route('blog2') }}">
                                            <i class="bi bi-journal-text me-2"></i>
                                            บทความทั้งหมด
                                        </a>

                                    @endif

                                    <!-- Divider -->
                                    <div class="dropdown-divider"></div>

                                    <!-- Logout -->
                                    @if (Route::has('logout'))

                                        <a class="dropdown-item"
                                           href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            ออกจากระบบ

                                        </a>

                                        <!-- Logout Form -->
                                        <form id="logout-form"
                                              action="{{ route('logout') }}"
                                              method="POST"
                                              class="d-none">

                                            @csrf

                                        </form>

                                    @endif

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>


        <!-- ========================================
             MAIN CONTENT
        ========================================= -->
        <main class="container py-4">

            @yield('content')

        </main>

    </div>


    <!-- ========================================
         JQUERY
    ========================================= -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!-- ========================================
         SUMMERNOTE LITE
    ========================================= -->

    <!-- Summernote Lite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"
          rel="stylesheet">

    <!-- Summernote Lite JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <!-- ========================================
         INITIALIZE SUMMERNOTE
    ========================================= -->

    <script>
        $(document).ready(function () {

            $('#content').summernote({

                placeholder: 'เขียนเนื้อหาบทความที่นี่...',

                tabsize: 2,

                height: 250,

                toolbar: [

                    ['style', ['style']],

                    ['font', [
                        'bold',
                        'underline',
                        'italic',
                        'clear'
                    ]],

                    ['fontname', ['fontname']],

                    ['color', ['color']],

                    ['para', [
                        'ul',
                        'ol',
                        'paragraph'
                    ]],

                    ['table', ['table']],

                    ['insert', [
                        'link',
                        'picture',
                        'video'
                    ]],

                    ['view', [
                        'fullscreen',
                        'codeview',
                        'help'
                    ]]

                ]

            });

        });
    </script>


</body>
</html>