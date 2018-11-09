@extends('layout.app')

@section('content')
    <tasques :tasks="{{$tasks}}"></tasques>

    @endsection