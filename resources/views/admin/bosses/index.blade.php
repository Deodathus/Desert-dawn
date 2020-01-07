@extends('admin.layouts.main')

@section('content')

    <boss-manage
        url="{{ route('admin.bosses.store') }}"
        name="{{ app('collapseNames')['admin']['bosses']['manage'] }}"
        :items='@json($bosses)'
        rarities_api_url="{{ route('API.item.rarities.get') }}">
    </boss-manage>

@endsection
