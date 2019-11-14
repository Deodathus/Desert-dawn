@extends('admin.layouts.main')

@section('content')

    <user-manage-all
        name="{{ app('collapseNames')['admin']['users']['manage-all'] }}"
        url="{{ route('admin.manage.all.users.add.currencies') }}">
    </user-manage-all>

@endsection
