@extends('master')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <a href="{{ route('permission') }}" class="btn btn-info my-2">List</a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Permission</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('permission.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                            value="{{ $permission->name }}" placeholder="Name">
                                        @error('name')
                                            <strong class="text-danger my-1">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
