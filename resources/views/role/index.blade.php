@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php 

    if(\Auth::user()){
?>
 

                <a class="btn btn-primary" href="{{ route('role.add') }}">Add</a>
<?php 
    }
    elseif(session('user') && session('layout')=='2'){   
?>
				<a class="btn btn-primary" href="{{ route('role2.add') }}">Add</a>
<?php 
    }
    elseif(session('user') && session('layout')=='3'){
?>
				<a class="btn btn-primary" href="{{ route('role3.add') }}">Add</a>
<?php 
    }
?>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                    <th scope="col">dispalay name</th>
                    <th scope="col">guard name</th>
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
<?php 
    if(\Auth::user()){
?>

                            <a class="btn btn-primary" href={{ route('role.edit'   , ['id' => $role->id]) }}>Edit</a>
                    
                            <a class="btn btn-danger" href="{{ route('role.delete' , ['id' => $role->id]) }}">Delete</a>

<?php 
    }
    elseif(session('layout') == '2'){
?>
							<a class="btn btn-primary" href={{ route('role2.edit'   , ['id' => $role->id]) }}>Edit2</a>
                    
                            <a class="btn btn-danger" href="{{ route('role2.delete' , ['id' => $role->id]) }}">Delete</a>
<?php 
    }
    elseif(session('layout') == '3'){
?>
							<a class="btn btn-primary" href={{ route('role3.edit'   , ['id' => $role->id]) }}>Edit3</a>
                    
{{--                            <a class="btn btn-danger" href="{{ route('role3.delete' , ['id' => $role->id]) }}">Delete</a>		--}}
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




