@extends('layouts.app')
@section('content')
<h1>Welcome to logged in {{ auth()->user()->name }} as  User !!!</h1>

  <task-index></task-index>
    
@endsection