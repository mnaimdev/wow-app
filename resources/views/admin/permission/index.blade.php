@extends('master')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <a href="{{ route('permission.create') }}" class="btn btn-primary my-2">Add New</a>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Permission List</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $sl => $permission)
                                    <tr>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $permission->name }}</td>

                                        <td>
                                            <a href="{{ route('permission.edit', $permission->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a data-delete="{{ route('permission.delete', $permission->id) }}"
                                                class="btn btn-danger delete">Delete</a>
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
