
@extends('layouts.head')

@section('content')

    <div class="bosses container">
        <div class="boss-name">
            <h3>{{ $boss->name }}</h3>
            <h3>{{ session()->get('hp') }} / {{ $boss->hp }}</h3>
            <a href="{{ route('attack.first', $boss->id) }}" class="btn btn-danger boss-btn">Damage</a>
        </div>
    </div>

@endsection