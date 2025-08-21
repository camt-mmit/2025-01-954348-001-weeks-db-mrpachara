@extends('layouts.main', [
    'title' => "Products: {$title}",
])

@section('title')
    Products:
    <span @class($titleClasses ?? [])>{{ $title }}</span>
@endsection
