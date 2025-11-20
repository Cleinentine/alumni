@extends('layouts.app')

@section('content')
    <x-error-page code="400" text="Bad Request" message="Sorry, your request cannot be processed due to malformed syntax." />
@endsection