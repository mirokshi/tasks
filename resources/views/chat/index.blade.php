@extends('layouts.chat')

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection
