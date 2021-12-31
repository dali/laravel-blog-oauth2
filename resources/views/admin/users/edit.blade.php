@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">{{ __('Edit role user') }}</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('put')

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="slug" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="roles" class="col-md-2 col-form-label text-md-end">Roles</label>
                            @if ($roles->count() > 0)
                                <div class="col-md-8">
                                        <select name="roles[]" id="roles" 
                                                class="select2" 
                                                multiple="multiple" 
                                                data-placeholder="Select role" 
                                                data-dropdown-css-class="select2-purple" 
                                                style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @if(isset($user))
                                                        @if ($user->hasRole($role->id))
                                                            selected
                                                        @endif
                                                    @endif
                                                    
                                                    >{{ $role->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                            @endif
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

    
@endsection