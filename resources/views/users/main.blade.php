@extends('layouts.main', [
    'title' => "Users: {$title}" . (isset($subTitle) ? " {$subTitle}" : ''),
])

@section('title')
    Users:
    <span @class($titleClasses ?? [])>{{ $title }}</span>
    @isset($subTitle)
        <span @class($subTitleClasses ?? [])>{{ $subTitle }}</span>
    @endisset
@endsection
