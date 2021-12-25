@extends('layouts.app')
@section('title', $post->meta_title) 
@section('description', $post->meta_description)
@section('content')
<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            {{ $post->title }}
            
        </h3>
        <div class="blog-post">
            <p class="blog-post-meta">{{ $post->publish_date }} by <a href="#">{{ $post->author->name }} </a></p>
            <p class="blog-post-meta">{{ $post->excerpt }} </p>
            <p class="blog-post-meta">{{ $post->body }} </p>
        </div>
        </div>
    </div>
</main>  
@endsection