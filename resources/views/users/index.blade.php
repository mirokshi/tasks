@extends('layouts.app')

@section('title')
	Usuaris
@endsection

@section('content')
	<v-container fluid>
		<v-layout>
			<v-flex>
				<users :users="{{ $users }}"></users>
			</v-flex>
		</v-layout>
	</v-container>
@endsection
