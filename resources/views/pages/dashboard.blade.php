@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:25px;">
    <div class="row" style="justify-content: center;">
        <h6>DASHBOARD</h6>
    </div>
    <div>
    	<h2>Welcome, {{ Auth::user()->name }}!</h2><br>
    </div>
</div>
@endsection
