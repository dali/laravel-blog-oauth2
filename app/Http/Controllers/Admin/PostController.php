<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
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



    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }


    public function create()
    {
       return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $author = Auth::user();
        $file = $request->file('image_url');
        $post = new Post($request->all());
        $post->addMedia($file)->toMediaCollection();
        $post->author()->associate($author);
        $post->save();

        return redirect()->route('posts.index')->withStatus(__('Post successfully created.'));

    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', ['post' => $post]);
    }

     /**
     * Update the post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $file = $request->file('image_url');
        $post = Post::findOrFail($id);
        $post->update($request->all());
        $post->addMedia($file)->toMediaCollection();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
