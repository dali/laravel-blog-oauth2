<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function index()
    {
        //abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }



    public function show(Post $post)
    {
        
        return view('admin.posts.show', compact('post'));
    }


    public function create()
    {
       $tags = Tag::all();
       return view('admin.posts.create')->with('tags', $tags);
    }

    public function store(StorePostRequest $request)
    {
        $author = Auth::user();
        $author->posts()
               ->create($request->all())
               ->tags()
               ->attach($request->tags);
        
        $file = $request->file('image_url');
        if($request->hasFile('image_url') && $file->isValid()){
            $author->posts->last()->addMedia($file)->toMediaCollection();
        }
       
        return redirect()->route('admin.posts.index')
                         ->withStatus(__('Post successfully created.'));

    }


    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

     /**
     * Update the post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $file = $request->file('image_url');
        $post->update($request->all());
        if($request->hasFile('image_url')){
            $post->addMedia($file)->toMediaCollection();
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
                        ->with('success','Post deleted successfully');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
