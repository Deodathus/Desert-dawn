@extends('admin.layouts.main')

@section('content')

    <boss-edition
        boss_id="{{ $boss->id }}"
        api_url="{{ route('API.boss.get') }}"
        url="{{ route('admin.bosses.update', $boss) }}">
    </boss-edition>

@endsection
