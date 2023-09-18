@extends('master')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <a href="{{ route('add.role.permission') }}" class="btn btn-primary my-2">Role in Permission</a>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>All Roles</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $sl => $role)
                                    <tr>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>


                                            @forelse ($role->permissions as $permission)
                                                <span class="text-primary m-1">
                                                    {{ $permission->name }}
                                                </span>
                                            @empty
                                                <span>NA</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.role.permission', $role->id) }}" class="btn btn-primary"
                                                width="40">Edit</a>
                                            <a data-delete="{{ route('delete.role.permission', $role->id) }}"
                                                class="btn btn-danger delete">X</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const deleteBtn = document.querySelectorAll('.delete');
        deleteBtn.forEach((item) => {
            item.addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const link = this.getAttribute('data-delete');
                        location.href = link;
                    }
                })
            });
        });
    </script>
@endsection
