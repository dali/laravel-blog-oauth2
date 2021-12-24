@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">{{ __('Create a new post') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="meta_title" class="col-md-2 col-form-label text-md-end">{{ __('SEO title ') }}</label>

                        <div class="col-md-8">
                            <input id="meta_title" type="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title') }}" required autocomplete="meta_title" autofocus>

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
                                <input id="meta_description" type="meta_description" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" value="{{ old('meta_description') }}" required autocomplete="meta_description" autofocus>

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
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label text-md-end">{{ __('Slug') }}</label>

                            <div class="col-md-8">
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}"  autocomplete="slug" autofocus>

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
                                
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="validationTextarea" name="excerpt" value="{{ old('excerpt') }}" placeholder="Description for the post" required autocomplete="excerpt" autofocus></textarea>
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
                                <textarea rows="10"  class="form-control @error('body') is-invalid @enderror" id="validationTextarea" name="body" value="{{ old('body') }}" placeholder="Body of the post"  autocomplete="body" autofocus></textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1"  {{ old('published', 0) === 1 ? 'checked' : '' }}>
                                    
                                    <label class="form-check-label" for="published">
                                        {{ __('published') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="publish_date" class="col-md-2 col-form-label text-md-end">{{ __('publish_date') }}</label>

                            <div class="col-md-8">
                                <input id="publish_date" type="text" class="form-control @error('publish_date ') is-invalid @enderror" name="publish_date" value="{{ old('publish_date ') }}" required autocomplete="publish_date " autofocus>

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
                                    {{ __('Submit') }}
                                </button>
                            </div>
                            
                        </div>
                  </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script>
    $('#title').change(function(e){
        $.get('{{ route('posts.checkSlug') }}',
        { 'title': $(this).val() },
        function(data){
            $('#slug').val(data.slug);
        }
        );
    });
</script>
@endsection