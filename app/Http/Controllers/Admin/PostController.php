<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    

    public function index()
    {
        
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }



    public function show(Post $post)
    {
        $this->authorize('view-post', $post);
        return view('admin.posts.show', compact('post'));
    }


    public function create()
    {
       $tags = Tag::all();
       $categories = Category::all();
       return view('admin.posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        $author = Auth::user();
        $author->posts()->create($request->all());

        $post = $author->posts->last(); 
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        
        $file = $request->file('image_url');

        if($request->hasFile('image_url') && $file->isValid()){
            $post->addMedia($file)->toMediaCollection();
        }
       
        return redirect()->route('admin.posts.index')
                         ->withStatus(__('Post successfully created.'));

    }


    public function edit(Post $post)
    {
        $this->authorize('update-post', $post);

        return view('admin.posts.edit')->with('post', $post)
                                       ->with('categories', Category::all())
                                       ->with('tags', Tag::all());
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

        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }

        $file = $request->file('image_url');
        $post->update($request->all());
        
        if($request->hasFile('image_url')){
            $post->addMedia($file)->toMediaCollection();
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
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
