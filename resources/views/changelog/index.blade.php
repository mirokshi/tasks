@extends('layouts.app')

@section('title')
    Changelog
@endsection

@section('content')
    <changelog :logs="{{ $logs }}" :users="{{ $users }}"></changelog>
@endsection
