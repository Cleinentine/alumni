@extends('layouts.app')

@section('content')
    <x-error-page code="429" text="Too many request" message="Whoa there! You've sent too many requests in a short period of time. Please wait a few minutes and try again." />
@endsection