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

                    <label for="email" class="here1" value="dayr">Email 3</label>

                    <input type="email" class="form-control" placeholder="Enter email" name="email"

                           value="{{ $user->email }}">
                </div>
<?php
// dd($listRoleOfUser);
?>

                <select class="form-control" style="margin-bottom: 20px;" name="roles[]" multiple="multiple" size="7">

                    @foreach($roles as $role)

                        <option     {{ $listRoleOfUser->contains($role->id) 	?	 'selected' 	:	 '' }}

                                    class = 'roleid'    value = "{{ $role->id }}">

                            {{ $role->name }}
                        </option>

                    @endforeach

                </select>
<?php
    if(session('layout') !== '3'){
?>
                <div class="form-group">

                    <div class='row'>

                    	<div class='col-sm'>

                        	<label for="email">User Permissions by Role</label>

                            @foreach($permissions as $permission)

                                <div class="form-check">

                                    <input 	type="checkbox"	class="form-check-input" name="permission[]" value="{{ $permission->id }}" disabled="disabled"

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

                            <div id="permis">click a role to view its permissons</div>

                    	</div>

                    </div>

                </div>
<?php
    }
?>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
{{--
<script src="{{asset('public/js/jquery.js')}}"></script> --}}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">


        function remove_background(product_id)
         {
          for(var count = 1; count <= 5; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ccc');
          }
        }

        $(document).ready(function(){

//            alert(".roleid"+{{ $role->id }});

            var listsize = {{$roles->count()}}

            //          alert('here ' +listsize);

            $(".roleid").click(function(){

                var index = $(this).val();

//                var product_id = $(this).data('product_id');
                var _token = $('input[name="_token"]').val();

                $.ajax({

                    url         :"{{url('checkpermi')}}",
                    method      :"POST",

                    data        :
                    {
                        index       :index,
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

