@extends('admin.layouts.main')

@section('content')

    <user-create-form :edition_mode="true" api_url="{{ route('API::user::get') }}" user_id="{{ $user->id }}">
    </user-create-form>

@endsection
