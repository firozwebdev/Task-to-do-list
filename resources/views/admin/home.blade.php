@extends('layouts.app')
@section('content')
    
        <h1>Welcome to logged in {{ auth()->user()->name }} as  Admin !!!</h1>
        <admin-home></admin-home>
    
@endsection