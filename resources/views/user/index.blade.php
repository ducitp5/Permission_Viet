@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
 <?php
    if(\Auth::user()){
 ?>
                <a class="btn btn-primary" href="{{ route('user.add') }}">Add</a>
 <?php
    }
    elseif(session('layout') == '2'){
 ?>
				<a class="btn btn-primary" href="{{ route('user2.add') }}">Add</a>
<?php
    }
    elseif(session('layout') == '3'){
?>
				<a class="btn btn-primary" href="{{ route('user3.add') }}">Add</a>
<?php
    }
?>
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
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
<?php
    if(session('layout') == '2' || \Auth::user() ){

        foreach ($user->roles()->get() as $key => $role) {
?>
                            <span class="badge badge-danger"> {{ $role->name }} </span>
<?php
        }
?>
                        </td>

                        <td>
<?php
        foreach ($user->permissionByModel() as $key => $permi) {
?>
                            <span class="badge badge-danger"> {{ $permi->name }} </span>
<?php
        }
    }
    else{

        foreach ($user->roles()->get() as $key => $role) {
?>
                            <span class="badge badge-danger"> {{ $role->name }} </span>
<?php
        }
?>
                        </td>

                        <td>
<?php
        foreach ($user->getPermissionsViaRoles()->unique('id') as $key => $permi) {
?>
                            <span class="badge badge-danger"> {{ $permi->name }} </span>
<?php
        }
    }
?>
                        </td>

                        <td>
 <?php
    if(\Auth::user()){
 ?>
                            <a class="btn btn-primary" href={{ route('user.edit'  , ['id' => $user->id]) }}>Edit</a>

                            <a class="btn btn-danger" href="{{ route('user.delete', ['id' => $user->id]) }}">Delete</a>
 <?php
    }
    elseif(session('layout') == '2'){
 ?>
							<a class="btn btn-primary" href={{ route('user2.edit'  , ['id' => $user->id]) }}>Edit</a>

                            <a class="btn btn-danger" href="{{ route('user2.delete', ['id' => $user->id]) }}">Delete</a>
<?php
    }
    elseif(session('layout') == '3'){
?>
							<a class="btn btn-primary" href={{ route('user3.edit'  , ['id' => $user->id]) }}>Edit</a>

                            <a class="btn btn-danger" href="{{ route('user3.delete', ['id' => $user->id]) }}">Delete</a>
<?php
    }
?>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection




























