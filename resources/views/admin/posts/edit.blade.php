@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">{{ __('Edit post') }}</div>
            <div class="card-body">
                @include('partials.errors')
                <form method="post" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <label for="meta_title" class="col-md-2 col-form-label text-md-end">{{ __('SEO title ') }}</label>

                        <div class="col-md-8">
                            <input id="meta_title" type="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ $post->title }}" required autocomplete="meta_title" autofocus>

                            @error('meta_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                            <label for="meta_description" class="col-md-2 col-form-label text-md-end">{{ __('SEO Description') }}</label>

                            <div class="col-md-8">
                                <input id="meta_description" type="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" value="{{ $post->meta_description }}" required autocomplete="meta_description" autofocus>

                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Upload Image') }}</label>

                            <div class="col-md-8">
                                <input class="form-control form-control @error('image_url') is-invalid @enderror" id="image_url" value="{{ $post->image }}" name="image_url" type="file">
                                <img src="{{ $post->image }}" alt="">
                                @error('image_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label text-md-end">{{ __('Slug') }}</label>

                            <div class="col-md-8">
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $post->slug }}"  autocomplete="slug" autofocus>

                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="excerpt" class="col-md-2 col-form-label text-md-end">{{ __('Excerpt') }}</label>

                            <div class="col-md-8">
                                
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="validationTextarea" name="excerpt"  placeholder="Description for the post" required autocomplete="excerpt" autofocus>
                                    {{ $post->excerpt }}
                                </textarea>
                                @error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="body" class="col-md-2 col-form-label text-md-end">{{ __('body') }}</label>

                            <div class="col-md-8">
                                <textarea rows="10"  class="form-control @error('body') is-invalid @enderror" id="validationTextarea" name="body"  placeholder="Body of the post"  autocomplete="body" autofocus>
                                    {{ $post->body }}
                                </textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tags" class="col-md-2 col-form-label text-md-end">Tags</label>
                            @if ($tags->count() > 0)
                                <div class="col-md-8">
                                        <select name="tags[]" id="tags" multiple="" class="form-control">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    @if(isset($post))
                                                        @if ($post->hasTag($tag->id))
                                                            selected
                                                        @endif
                                                    @endif
                                                    
                                                    >{{ $tag->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-2 col-form-label text-md-end">Category</label>
                            <div class="col-md-8">
                                    @if ($tags->count() > 0)
                                            <select name="category_id" id="category" 
                                                    class="select2" 
                                                    style="width: 100%;">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($post->category($category->id))
                                                            selected
                                                        @endif
                                                        >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                       
                                    @endif
                            </div>
                                
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input type="hidden" name="published" value="0">
                                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $post->published || old('published', 0) === 1 ? 'checked' : '' }}>
                                            
                                    <label class="form-check-label" for="published">
                                        {{ __('published') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="publish_date" class="col-md-2 col-form-label text-md-end">{{ __('publish_date') }}</label>

                            <div class="col-md-8">
                                <input id="publish_date" type="text" class="form-control @error('publish_date ') is-invalid @enderror" name="publish_date" value="{{ $post->publish_date }}" required autocomplete="publish_date " autofocus>

                                @error('publish_date ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>
                            
                        </div>
                  </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $('#title').change(function(e){
        $.get('{{ route('admin.posts.checkSlug') }}',
        { 'title': $(this).val() },
        function(data){
            $('#slug').val(data.slug);
        }
        );
    });
</script>
    
@endsection