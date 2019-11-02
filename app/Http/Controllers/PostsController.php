<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostsRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Post\UpdatePostRequest;

class PostsController extends Controller
{
    /**
     * Constructor Definition
     */
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //upload image to storage
        $image = $request->image->store('posts');

        //Create the Post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        // flash message
        session()->flash('success', 'Post Created Successfully');

        // redirect user
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }

    /**
     * Display the specified resource
     */
    public function category(Category $category)
    {
        

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(3))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    /**
     * Display the specified resource
     */
    public function tag(Tag $tag)
    {
        return view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $tag->posts()->searched()->simplePaginate(3));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);

        // check if new image
        if($request->hasFile('image')){
            // upload it
            $image = $request->image->store('posts');

            // delete the old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        // update attributes
        $post->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully');

        // redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }else{
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display a list of trashed posts
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    /**
     * Restore Posts
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect()->back();
    }
}
