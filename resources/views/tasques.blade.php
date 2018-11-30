@extends ('layout.app')
@section('title')
    Tasques
     @endsection
@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tasques :tasks="{{$tasks}}" :users="{{$users}}" :uri="{{$uri}}"></tasques>
                {{--@if(Auth::user()->can('tasks.manage'))--}}
                {{--<tasques :tasks="{{$tasks}}" :uri="/api/v1/tasks"></tasques>--}}
                {{--@else--}}
                {{--<tasques :tasks="{{$tasks}}" :uri="/api/v1/user/tasks" ></tasques>--}}
                {{--@endif--}}

                {{--<tasques :tasks="{{$tasks}}" :uri="/api/v1/tasks"></tasques>--}}
                {{--@endsection--}}
            </v-flex>
        </v-layout>
    </v-container>

@endsection