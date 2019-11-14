@extends('admin.layouts.main')

@section('content')

    <user-manage-all name="{{ app('collapseNames')['admin']['users']['manage-all'] }}">
    </user-manage-all>

@endsection
