@extends('layouts.app')
@section('title', "all categories") 
@section('description', "all categories")

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
                      <h3 class="card-title">{{ __('Categories') }}</h3>
                      
                      <div class="card-tools">
                        <a class="btn btn-success" href="{{ route('admin.categories.create') }}"> create new category</a>
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
                            @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->name }} </th>
                                    <td>{{ $category->slug }} </td>
                                    <td>{{ $category->posts->count() }} </td>
                                    <td colspan="6">
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="inline-block">     
                                            <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category) }}">Edit</a>   
                                            @csrf
                                            @method('DELETE')      
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                          <tr>
                            <td>There is no categories</td>
                          </tr>
                        @endif
                        </tbody>
                      </table>
                      
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer clearfix">
                        {!! $categories->links() !!}
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