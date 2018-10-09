@extends ('layout.app')

@section('content')
    <tasks :tasks="{{$tasks}}"></tasks>
@endsection