@extends('layouts.app')
@section('title', "all posts") 
@section('description', "all posts")

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="col-md-12">
            <div class="float-start">
                <h2>{{ __('All posts') }}</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>
            </div>

        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('title') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('published') }}</th>
                    <th scope="col">{{ __('publish_date') }}</th>
                    <th scope="col">{{ __('author') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @if ($posts->count())
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }} </th>
                                <td>{{ $post->title }} </td>
                                <td><img src="{{ $post->image }}" alt="" > </td>
                                <td>{{ $post->published }} </td>
                                <td>{{ $post->publish_date }} </td>
                                <td>{{ $post->author->name }} </td>
                                <td colspan="6">
                                    {{-- <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.show',$post->id) }}">Show</a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.edit',$post->id) }}">Edit</a> --}}
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">   
                                        <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">Show</a>    
                                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>   
                                        @csrf
                                        @method('DELETE')      
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p>There is no posts</p>
                    @endif
                </tbody>
            </table>
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@endsection