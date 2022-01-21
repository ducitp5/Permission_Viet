@extends('layouts.app'.session('layout'))


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

				<a class="btn btn-primary" href="{{ route('role3.add') }}">Add</a>

            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                    <th scope="col">dispalay name</th>
                    <th scope="col">guard name</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>

    @foreach($listRole as $role)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>

                        <td>{{ $role->id }}</td>

                        <td>{{ $role->name }}</td>

						<td>{{ $role->display_name }}</td>

                        <td>{{ $role->guard_name }}</td>

                        <td>
                            @foreach ( $role->permissions()->get() as $permis )

                                <span class="badge badge-danger"> {{ $permis->name }} </span>

                            @endforeach
                        </td>

                        <td>

							<a class="btn btn-primary" href={{ route('role3.edit'   , ['id' => $role->id]) }}>Edit3</a>

                            <a class="btn btn-danger" href="{{ route('role3.delete' , ['id' => $role->id]) }}">Delete</a>

                        </td>
                    </tr>
    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection




