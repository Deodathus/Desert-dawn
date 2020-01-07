@extends('admin.layouts.main')

@section('content')

    <item-manage
        url="{{ route('admin.items.store') }}"
        name="{{ app('collapseNames')['admin']['items']['manage'] }}"
        :items='@json($items)'
        item_rarities_api_url="{{ route('API.item.rarities.get') }}"
        item_types_api_url="{{ route('API.item.types.get') }}">
    </item-manage>

@endsection
