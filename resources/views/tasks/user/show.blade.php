@extends('layouts.app')
@section('title')
    Tareas
     @endsection
@section('content')
    <show-task :task="{{$task}}" :tags="{{$tags}}"></show-task>
     @endsection
