@extends('admin.layouts.main')

@section('content')

    <user-edition
        api_url="{{ route('API.user.get') }}"
        user_id="{{ $user->id }}"
        url="{{ route('admin.users.update', $user) }}">
    </user-edition>

    <b-button variant="outline-primary" href="{{ route('admin.login.as.user', $user) }}">
        Login As
    </b-button>

@endsection
