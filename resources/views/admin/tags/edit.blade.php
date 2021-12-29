@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">{{ __('Edit tag') }}</div>
            <div class="card-body">
                @include('partials.errors')
                <form method="post" action="{{ route('admin.tags.update', $tag) }}">
                    @csrf
                    @method('put')

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $tag->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slug" class="col-md-2 col-form-label text-md-end">{{ __('Slug') }}</label>

                            <div class="col-md-8">
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $tag->slug }}"  autocomplete="slug" autofocus>

                                @error('slug')
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
    $('#name').change(function(e){
        $.get('{{ route('admin.tags.checkSlug') }}',
        { 'name': $(this).val() },
        function(data){
            $('#slug').val(data.slug);
        }
        );
    });
</script>
    
@endsection