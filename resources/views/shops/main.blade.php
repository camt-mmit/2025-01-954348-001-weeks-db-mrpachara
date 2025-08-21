@extends('layouts.main', [
    'title' => "Shops: {$title}",
])

@section('title')
    Shops:
    <span @class($titleClasses ?? [])>{{ $title }}</span>
@endsection
