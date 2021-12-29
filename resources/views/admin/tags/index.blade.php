@extends('layouts.app')
@section('title', "all tags") 
@section('description', "all tags")

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
                        <a class="btn btn-success" href="{{ route('admin.tags.create') }}"> create new tag</a>
                        {{-- <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
      
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                          
                        </div> --}}
                        
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Slug') }}</th>
                            <th scope="col">{{ __('Post count') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ($tags->count())
                            @foreach ($tags as $tag)
                                <tr>
                                    <th scope="row">{{ $tag->name }} </th>
                                    <td>{{ $tag->slug }} </td>
                                    <td>{{ $tag->posts->count() }} </td>
                                    <td colspan="6">
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" style="inline-block">     
                                            <a class="btn btn-primary" href="{{ route('admin.tags.edit', $tag) }}">Edit</a>   
                                            @csrf
                                            @method('DELETE')      
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                          <td>There is no tags</td>
                        </tr>
                        @endif
                        </tbody>
                      </table>
                      
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer clearfix">
                        {!! $tags->links() !!}
                      </div> --}}
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
      <!-- /.content-header -->
    </div><!-- /.container-fluid -->
</section>

@endsection