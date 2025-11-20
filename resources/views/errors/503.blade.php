@extends('layouts.app')

@section('content')
    <x-error-page code="503" text="Service Unavailable" message="Sorry, the server is currently unavailable. Please try again later." />
@endsection