@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))


@section('content')

    <div class="container">
        <div class="row">
        
            <form class="col-md-8" method="post" action="">
                @csrf

				<div class="form-group">
                    <label for="name">Role Id : {{ $role->id }}</label>                
                </div>
                
                <div class="form-group">
                    <label for="name">Name</label>
                
                    <input 	type="text" class="form-control" placeholder="Enter name" 
                    
                    		name="name" 			value="{{ $role->name }}">
                </div>
                
                <div class="form-group">
                    
                    <label for="display_name">Display name</label>
                    
                    <input 	type="text" class="form-control" placeholder="Enter display name" 
                    
                		    name="display_name" 	value="{{ $role->display_name }}">
                </div>


                @foreach($permissions as $permission)
                
                    <div class="form-check">                    	
                                 
                        <input 	type="checkbox"	class="form-check-input" name="permission[]" value="{{ $permission->id }}"
                        
                        		{{ $getAllPermissionOfRole->contains($permission->id) 	 ?	 'checked' 	  :   '' }} >
                        
                        <label class="form-check-label" >
                        
                        	{{ $permission->id }}   :                      	
                        	
                        </label>
                               
                        <label class="form-check-label" >
                        
                        	@if(session('layout') == 3)	 {{ $permission->name }} 
                        	
                        	@else						 {{ $permission->display_name }}
                         	@endif
                        </label>
                                          
                    </div>
                    
                @endforeach


                <button type="submit" class="btn btn-primary">Submit</button>
                
            </form>
            
        </div>
    </div>

@endsection

