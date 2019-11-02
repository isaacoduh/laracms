<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/pixelf700.css')}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <main>
        <!-- Hero -->
        <div class="section-header section-sm text-white bg-primary overflow-hidden">
            <div class="container z-2">
                <div class="row mt-5 mb-4">
                    <div class="col-md-8 col-lg-7">
                        <h1 class="display-3 mt-5 mb-3">Blog</h1>
                        <p>Putting together stories and experiences from people with a diverse range of topics...</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-lg-6">
                        <div class="alert alert-sm alert-tertiary">
                            <div class="d-flex">
                                <span class="icon icon-xs icon-white">
                                    <i class="fas fa-puzzle-piece"></i>
                                </span>
                                <div class="alert-inner--text text-white ml-3 ml-md-2 flex-grow-1">Explore, read and enjoy...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section section-md pt-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-9">
                        {{-- article --}}
                        {{-- <div class="blog-card">
                            <div class="card-header pb-2">
                                <div class="post-meta">
                                    <div class="media d-block d-md-flex justify-content-between">
                                        <div>
                                            <a href="" class="font-small font-weight-bold">
                                                <img src="{{asset('img/team/9.jpg')}}" class="avatar-sm img-fluid rounded-circle mr-2" alt=""> John Smith
                                            </a>
                                            <span class="d-none d-md-inline font-small ml-1 font-weight-light">8h ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-3">
                                <a href="">
                                    <img src="{{asset('img/blog/blog-article-1.jpg')}}" class="card-img-top" alt="image">
                                </a>
                                <div class="align-items-center d-flex d-lg-none mt-3"></div>
                                <div class="mt-2 mt-lg-5">
                                    <a href="#" class="badge badge-sm badge-secondary text-uppercase">Technology</a>
                                    <a href="" class="badge badge-sm badge-primary text-uppercase">Business</a>
                                    <a href="#">
                                        <h2 class="mt-3 mb-4">List of Public corporations by market capitalization</h2>
                                    </a>
                                </div>
                                <p class="card-text mb-0 mb-lg-4">
                                        All of the world's 10 largest companies as measured by market capitalization are American. Market capitalization is the total value of a company's entire purchased shares of stock. While these companies have their roots in the U.S. and are the embodiment of ...
                                </p>
                            </div>
                        </div> --}}
                        {{-- End article --}}

                        @yield('mainblog')
                    </div>
                    <aside class="col-12 col-lg-3 mt-3 mt-lg-0 d-none d-lg-block">
                        @yield('aside')
                        

                        
                    </aside>
                </div>
               
            </div>
        </div>
    </main>
</body>
</html>