@extends('admin.layouts.main')

@section('content')

    <item-edition
        item_id="{{ $item->id }}"
        url="{{ route('admin.items.update', $item) }}"
        item_rarities_api_url="{{ route('API.item.rarities.get') }}"
        item_types_api_url="{{ route('API.item.types.get') }}"
        api_url="{{ route('API.item.get') }}">
    </item-edition>

@endsection
