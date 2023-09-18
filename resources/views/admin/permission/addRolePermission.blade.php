@extends('master')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Role in Permission</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('role.permission.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label>Role</label>
                                        <select name="role_id"
                                            class="form-control @error('role_id')
                                            is-invalid
                                        @enderror">
                                            <option selected disabled>-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('role_id')
                                            <strong class="text-danger my-1">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>
                                </div>



                            </div>


                            <div class="row">


                                <div class="col-lg-12">
                                    <label class="my-2">Permissions</label>
                                    @foreach ($permissions as $permission)
                                        <div class="form-group mb-3">
                                            <input type="checkbox" name="permission_id[]"
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
