@extends( \Auth::user()		?	  'layouts.app'		:	'layouts.app'.session('layout') )

@section('content')
    <div class="container">
        <div class="row">
            <h2>Are you crayzy</h2>
        </div>
    </div>

@endsection

