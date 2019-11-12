@extends('admin.layouts.main')

@section('content')

    <user-manage
        :users="{{ $users }}"
        url="{{ route('admin.users.store') }}">
    </user-manage>

@endsection
