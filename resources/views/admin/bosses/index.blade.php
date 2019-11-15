@extends('admin.layouts.main')

@section('content')
    <boss-manage
        url="{{ route('admin.bosses.store') }}"
        name="{{ app('collapseNames')['admin']['bosses']['manage'] }}">
    </boss-manage>
@endsection
