@extends('layout.app')

@section('content')
    <changelog :logs="{{ $logs }}" :users="{{ $users }}"></changelog>
@endsection
