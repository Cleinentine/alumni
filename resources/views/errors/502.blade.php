@extends('layouts.app')

@section('content')
    <x-error-page code="502" text="Bad Gateway" message="Sorry, the server received an invalid response from the upstream server." />
@endsection