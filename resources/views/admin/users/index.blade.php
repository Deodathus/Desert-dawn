@extends('admin.layouts.main')

@section('content')

    <user-manage
        :users='@json($users)'
        url="{{ route('admin.users.store') }}"
        name="{{ app('collapseNames')['admin']['users']['manage'] }}">
    </user-manage>

@endsection
