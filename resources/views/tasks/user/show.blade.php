@extends('layouts.app')
@section('content')
    <show-task :task="{{$task}}" :tags:{{$tags}}></show-task>
     @endsection
