@extends('layouts.blog')

@section('title')
    Category {{$category->name}}
@endsection

@section('mainblog')
    <h1 class="mt-5">
        {{$category->name}}
    </h1>
    @forelse ($posts as $post)
`   <div class="blog-card">
        <div class="card-header pb-2">
            <div class="post-meta">
                <div class="media d-block d-md-flex justify-content-between">
                    <div>
                        <a href="" class="font-small font-weight-bold"
                            <img src="{{Gravatar::src($post->user->email)}}" class="avatar-sm img-fluid rounded-circle mr-2" alt=""> {{$post->user->name}}
                        </a>
                        <span class="d-none d-md-inline font-small ml-1 font-weight-light">8h ago</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body py-3">
            <a href="{{route('blog.show', $post->id)}}">
                @if ($post->image)
                
                    <img src="{{asset('/storage/'.$post->image)}}" class="card-img-top" alt="image">
                @else
                    <img src="{{asset('img/blog/blog-article-1.jpg')}}" class="card-img-top" alt="image">
                @endif
                
            </a>
            <div class="align-items-center d-flex d-lg-none mt-3"></div>
            <div class="mt-2 mt-lg-5">
                <a href="#" class="badge badge-sm badge-secondary text-uppercase">{{$post->category->name}}</a>
                {{-- <a href="" class="badge badge-sm badge-primary text-uppercase">Business</a> --}}
                <a href="#">
                    <h2 class="mt-3 mb-4">{{$post->title}}</h2>
                </a>
            </div>
            <p class="card-text mb-0 mb-lg-4">

                    @if(strlen($post->content) > 100)
                    {{substr($post->content,0,100)}}....
                    @else
                    {{$post->content}}
                    @endif
            </p>
        </div>
    </div>
    @empty
        <p class="text-center">
            No results found for query <strong>{{request()->query('search')}}</strong>
        </p>
    @endforelse
    {{$posts->appends(['search' => request()->query('search')])->links()}}
@endsection


@section('aside')
    <ul class="card list-group list-group-flush shadow-soft border-soft p-3">
        @foreach ($categories as $category)
            <li class="list-group-item border-0 py-2 d-flex align-items-center justify-content-between">
                <a href="{{route('blog.category', $category->id)}}" class="text-primary">
                    <i class="fas fa-digital-tachograph mr-3"></i> 
                    {{$category->name}}
                    <span class="badge badge-soft text-uppercase">{{$category->posts->count()}}</span>
                </a>
            </li>
        @endforeach
        
    </ul>

    

    <ul class="card list-group list-group-flush shadow-soft border-soft p-3 mt-5">
        @foreach ($tags as $tag)
            <li class="list-group-item border-0 py-2 d-flex align-items-center justify-content-between">
                <a href="{{route('blog.tag', $tag->id)}}" class="text-primary">
                    <i class="fas fa-digital-tachograph mr-3"></i> 
                    {{$tag->name}}
                    <span class="badge badge-soft text-uppercase">{{$tag->posts->count()}}</span>
                </a>
            </li>
        @endforeach
        
    </ul>

    <div class="card shadow-soft border-soft p-3 mt-4">
        <h5 class="mb-4">Search</h5>
        <form action="" action="{{route('welcome')}}" method="GET">
            <input type="text" placeholder="" name="search" class="form-control" value="{{request()->query('search')}}">
        </form>
    </div>
@endsection