@extends('layouts.app')

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection
