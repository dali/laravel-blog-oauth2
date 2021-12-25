@extends('layouts.app')
@section('title', "all posts") 
@section('description', "all posts")

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
              <!-- /.row -->
</section>
<section class="content">
    <div class="container-fluid">      
        <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Responsive Hover Table</h3>
      
                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
      
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
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
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="inline-block">   
                                            <a class="btn btn-info" href="{{ route('admin.posts.show', $post) }}">Show</a>    
                                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">Edit</a>   
                                            @csrf
                                            @method('DELETE')      
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>There is no posts</p>
                        @endif
                        </tbody>
                      </table>
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {!! $posts->links() !!}
                      </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
      <!-- /.content-header -->
    </div><!-- /.container-fluid -->
</section>

@endsection