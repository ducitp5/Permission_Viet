@extends('layouts.app'.session('layout'))

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

				<a class="btn btn-primary" href="{{ route('user3.add') }}">Add</a>

            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>

                <tbody>

    @foreach($listUser as $user)

                    <tr <?= ($user->id == session('user')->id) ? 'style="background : rgb(29, 223, 45)"' : ''; ?> >
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
<?php

        foreach ($user->roles()->get() as $key => $role) {
?>
                            <span class="badge badge-danger"> {{ $role->name }} </span>
<?php
        }
?>
                        </td>

                        <td>
<?php
        foreach ($user->getAllPermissions()->unique('id') as $key => $permi) {
?>
                            <span class="badge badge-danger"> {{ $permi->name }} </span>
<?php
        }

?>
                        </td>

                        <td>
 							<a class="btn btn-primary" href={{ route('user3.edit'  , ['id' => $user->id]) }}>Edit</a>

                            <a class="btn btn-danger" href="{{ route('user3.delete', ['id' => $user->id]) }}">Delete</a>

                        </td>
                    </tr>
    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection




























