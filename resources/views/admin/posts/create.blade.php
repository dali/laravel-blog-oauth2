@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('Create a new post') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Advanced Form</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
        <div class="card">
                <div class="card-header">
                <h3 class="card-title">{{ __('Create a new post') }}</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-primary">Label</span>
                </div>
                <!-- /.card-tools -->
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    @include('partials.errors')
                    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
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
                                <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Upload Image') }}</label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input class="form-control custom-file-input @error('image_url') is-invalid @enderror" id="image_url" name="image_url" type="file">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                          </div>
                                   </div>
                                    
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
                                    
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                            id="validationTextarea" 
                                            name="excerpt" 
                                            placeholder="Description for the post" 
                                            required> {{ old('excerpt') }}</textarea>
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
                                    <textarea rows="10"  
                                            class="form-control @error('body') is-invalid @enderror" 
                                            id="validationTextarea" 
                                            name="body"
                                            placeholder="Body of the post"  
                                            required>
                                            {{ old('body') }}
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
                                <div class="col-md-8">
                                
                                    
                                        @if ($tags->count() > 0)
                                            <div class="select2-purple">
                                                <select name="tags[]" id="tags" 
                                                        class="select2" 
                                                        multiple="multiple" 
                                                        data-placeholder="Select tags" 
                                                        data-dropdown-css-class="select2-purple" 
                                                        style="width: 100%;">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                </div>
                                    
                            </div>
                            <div class="row mb-3">
                                <label for="category" class="col-md-2 col-form-label text-md-end">Category</label>
                                <div class="col-md-8">
                                        @if ($tags->count() > 0)
                                                <select name="category_id" id="category" 
                                                        class="select2" 
                                                        style="width: 100%;">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                           
                                        @endif
                                </div>
                                    
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label text-md-end" for="published">
                                    {{ __('published') }}
                                </label>
                                <div class="col-md-8">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                               name="published" 
                                               id="datepicker" 
                                               value="1"  {{ old('published', 0) === 1 ? 'checked' : '' }}>
                                        
                                        
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="publish_date" class="col-md-2 col-form-label text-md-end">{{ __('publish_date') }}</label>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker14" data-target-input="nearest">
                                            <input id="publish_date" data-target="datetimepicker14" placeholder="2021-12-22 00:00:00" type="text" class="form-control datetimepicker-input @error('publish_date ') is-invalid @enderror" name="publish_date" value="{{ old('publish_date ') }}" required autocomplete="publish_date " autofocus>

                                            <div class="input-group-append" data-target="#datetimepicker14" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

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
            <!-- /.card-body -->
                <div class="card-footer">
                    The footer of the card
                </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        
    </div>
</section>


@endsection

@section('script')
<script>
    $('#title').change(function(e){
        $.get('{{ route('admin.posts.checkSlug') }}',
        { 'title': $(this).val() },
        function(data){
            $('#slug').val(data.slug);
      });

});
</script>
    
@endsection