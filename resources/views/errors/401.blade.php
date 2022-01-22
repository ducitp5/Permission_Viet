@extends( \Auth::user()		?	  'layouts.app'		:	'layouts.app'.session('layout') )

@section('content')
    <div class="container">
        <div class="row">
            <h2>Bạn không có quyền vào màn hình này</h2>
        </div>
    </div>

@endsection

