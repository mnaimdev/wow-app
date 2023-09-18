@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="margin-top: 100px;">
                <div class="card">
                    <div class="card-header">
                        <h3>User List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">

                            @if (session('delete'))
                                <div class="alert alert-danger">
                                    {{ session('delete') }}
                                </div>
                            @endif


                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Approve Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $sl => $user)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $user->name == '' ? 'NA' : $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <form action="{{ route('user.approval') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $user->id }}">

                                            @if ($user->status == 'OFF')
                                                <button class="btn btn-primary" type="submit" value="ON" name="status"
                                                    class="">Approve</button>

                                                <button class="btn btn-danger" type="submit" value="OFF"
                                                    name="status">Reject</button>
                                            @else
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
