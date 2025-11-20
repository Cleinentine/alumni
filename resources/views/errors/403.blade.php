@extends('layouts.app')

@section('content')
    <x-error-page code="403" text="Forbidden" message="Sorry, you do not have permission to access this page." />
@endsection