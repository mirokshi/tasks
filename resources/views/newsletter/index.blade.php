@extends('layouts.app')

@section('content')
    <newsletters :newsletter="{{ $newsletter }}"></newsletters>
@endsection
