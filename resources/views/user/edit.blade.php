@extends( 	\Auth::user()		?	'layouts.app'		:	'layouts.app'.session('layout'))

@section('content')
    <div class="container">
        <div class="row">
            <form class="col-md-8" method="post" action="">
                @csrf
                <div class="form-group">

                    <p for="name">id : {{ $user->id }}</p>
                    <label for="name">Name</label>

                    <input type="text" class="form-control" placeholder="Enter name" name="name"

                           value="{{ $user->name }}">
                </div>

                <div class="form-group">

                    <label for="email" class="here1" value="dayr">Email</label>

                    <input type="email" class="form-control" placeholder="Enter email" name="email"

                           value="{{ $user->email }}">
                </div>

                <div class="form-group">

                    <div class='row'>

                    	<div class='col-sm'>
                            <label for="email">list Role</label>

                            @foreach($roles as $key => $role)

                                <div class="form-check roleid" id="role{{$key}}">
                                    <input    type="checkbox" {{ $listRoleOfUser->contains($role->id) 	?	 'checked' 	:	 '' }}

                                            name="roles[]"   value = "{{ $role->id }}" >

                                    <label class="form-check-label" >    {{ $role->id }} - {{ $role->name }}    </label>
                                </div>
                            @endforeach

                        </div>

                        <div class='col-sm'>

                            <div id="permis">click a role to view its permissons</div>

                    	</div>

                    </div>

                </div>

                <div class="form-group">

                    <div class='row'>

                    	<div class='col-sm'>

                        	<label for="email">User Permissions by Role</label>

                            @foreach($permissions as $permission)

                                <div class="form-check">

                                    <input 	type="checkbox"	class="form-check-input" name="permission[]" value="{{ $permission->id }}" disabled

                                    		{{ $PermissionOfUser->pluck('id')->contains($permission->id) 	 ?	 'checked' 	  :   '' }} >

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

                        <div class='col-sm'>

                            <div>direct permissions</div>
<?php
//dd($user->getDirectPermissions())
?>
                            @foreach($permissions as $permission)

                                <div class="form-check">

                                    <input    type="checkbox" {{ $user->getDirectPermissions()->contains($permission->id) 	?	 'checked' 	:	 '' }}

                                              name="directPermis[]"    value = "{{ $permission->id }}" >

                                    <label class="form-check-label" >    {{ $permission->id }} - {{ $permission->name }}    </label>
                                </div>
                            @endforeach

                    	</div>

                        <div class='col-sm'>

                            <div>All permissions</div>

                            @foreach($permissions as $permission)

                                <div class="form-check">

                                    <input    type="checkbox" {{ $user->getAllPermissions()->contains($permission->id) 	?	 'checked' 	:	 '' }}

                                              name="directPermis[]"    value = "{{ $permission->id }}" disabled>

                                    <label class="form-check-label" >    {{ $permission->id }} - {{ $permission->name }}    </label>
                                </div>
                            @endforeach

                    	</div>

                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>

<script src="{{asset('public/js/jquery.js')}}"></script>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script type="text/javascript">


        function remove_background()
        {
            for(var key = 0; key < $(".roleid").length; key++)
            {
                $('#role'+key).css({ "background-color" : "" });
            }
        }

        $(document).ready(function(){

            console.log($(".roleid"));
            console.log($(".roleid").length);

            $(".roleid").click(function(){

                remove_background()

                $(this).css({ "background-color" : "#aaa" });

                var roleID  =   $(this).children('input').val();

                var _token  =   $('input[name="_token"]').val();

                var url     =   "{{url('checkpermi')}}";

                if({{session('layout')}} == '3')    url     =   "{{url('checkpermi3')}}"

                $.ajax({

                    url         : url,
                    method      : "POST",

                    data        :
                    {
                        roleID      :roleID,
                        _token      :_token
                    },

                    success     :function(data)
                    {
                        $('#permis').html(data);
                    }
                });

            });
        });

    </script>

@endsection

