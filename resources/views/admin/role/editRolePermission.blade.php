@extends('master')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <a href="{{ route('role.permission') }}" class="btn btn-primary my-2">Permission Under Role</a>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Role in Permission</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('role.permission.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ $role->id }}">

                            <span class="bg-primary p-2 text-white">{{ $role->name }}</span>


                            <div class="row my-3">


                                <div class="col-lg-12">
                                    @foreach ($permissions as $permission)
                                        <div class="form-group mb-3">
                                            <input {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                type="checkbox" name="permission_id[]"
                                                class="form-check-input @error('permission_id')  is-invalid @enderror"
                                                value="{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </div>
                                    @endforeach
                                    <br>

                                    @error('permission_id')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#check').click(function(event) {
            if (this.checked) {
                $(':checkbox').prop('checked', true);
            } else {
                $(':checkbox').prop('checked', false);
            }
        });
    </script>
@endsection
