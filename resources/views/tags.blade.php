@extends ('layouts.app')
@section('title')
    Tags
     @endsection
@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tags :tags="{{ $tags }}" uri="{{$uri}}"></tags>
            </v-flex>
        </v-layout>
    </v-container>

@endsection
