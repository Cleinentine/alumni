@extends('layouts.app')

@section('content')
    <x-error-page code="401" text="Unauthorized" message="Sorry, you are not authorized to access this page." />
@endsection