@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))

@section('content')
    <div class="container">
        <div class="row">
            <form class="col-md-8" method="post" action="">
                @csrf
                <div class="form-group">
                
                    <label for="name">Name</label>
                    
                    <input type="text" class="form-control" placeholder="Enter name" name="name"
                    
                           value="{{ $user->name }}">
                </div>

                <div class="form-group">
                
                    <label for="email">Email</label>
                    
                    <input type="email" class="form-control" placeholder="Enter email" name="email"
                    
                           value="{{ $user->email }}">
                </div>
<?php 
// dd($listRoleOfUser); 
?>

                <select class="form-control" style="margin-bottom: 20px;" name="roles[]" multiple="multiple">

                    @foreach($roles as $role)
                    
                        <option     {{ $listRoleOfUser->contains($role->id) 	?	 'selected' 	:	 '' }}
                        
                                    value = "{{ $role->id }}">

                            {{ $role->name }}
                        </option>
                        
                    @endforeach

                </select>
                
                <div class="form-group">
                
                    <label for="email">Permissions</label>
                    
                    @foreach($permissions as $permission)
                
                        <div class="form-check">                    	
                                     
                            <input 	type="checkbox"	class="form-check-input" name="permission[]" value="{{ $permission->id }}"
                            
                            		{{ $PermissionOfUser->contains($permission->id) 	 ?	 'checked' 	  :   '' }} >
                            
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
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                
            </form>
        </div>
    </div>

@endsection

