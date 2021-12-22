@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))


@section('content')
    <div class="container">
        <div class="row">
        
            <form class="col-md-8" method="post" action="">
                @csrf

                <div class="form-group">
                    
                    <label for="name">Name</label>
                    
                    <input type="text" class="form-control" placeholder="Enter name" 			name="name">
                </div>
                
                <div class="form-group">
                    
                    <label for="display_name">Display name</label>
                    
                    <input type="text" class="form-control" placeholder="Enter display name" 	name="display_name" required>
                </div>


                @foreach($permissions as $permission)
                
                    <div class="form-check">
                    
                        <input type="checkbox" class="form-check-input" 	name="permission[]" 	value="{{ $permission->id }}">
<?php 
    if(\Auth::user() || (session('layout') =='2')){
?>                  
                        <label class="form-check-label" >{{ $permission->display_name }}</label>
<?php 
    }
    elseif(session('layout') =='3'){
?>
						<label class="form-check-label" >{{ $permission->name }}</label>
<?php 
    }
?>
                    </div>
                    
                @endforeach


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection

