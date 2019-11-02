@extends('layouts.blog')

@section('title')
    {{$post->title}}
@endsection

@section('mainblog')
    {{-- <header class="header text-white h-fullscreen pb-80" style="background-image: url({{}})"></header> --}}
    <div class="section section-md">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <article>
                        <header>
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <div class="post-group d-none d-lg-flex flex-column align-items-center">
                                        <a href="" class="text-center">
                                           <img src="" class="avatar-lg avatar-sm-lg img-fluid rounded-circle mb-2" alt="avatar">
                                           <div class="font-small text-center">
                                                <span class="text-gray">By</span> {{$post->user->name}}
                                            </div> 
                                        </a>
                                        <p class="font-small font-weight-light text-center mb-2">
                                            Published <time datetime="">{{$post->published_at}}</time>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-11 col-lg-9">
                                    <h1 class="mb-2 mb-lg-4">
                                        <strong>{{$post->title}}</strong>
                                    </h1>
                                    <h2 class="text-gray font-medium font-weight-light">
                                        {{$post->description}}
                                    </h2>
                                </div>
                            </div>
                        </header>
                        <div class="my-5">
                            {!!$post->content!!}

                            <footer class="mt-5">
                                <div class="row mb-5">
                                    <div class="col-9">
                                        <div class="wi-tags">
                                            @foreach ($post->tags as $tag)
                                                <a href="">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection