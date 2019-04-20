
@extends('layouts.head')

@section('content')

    <div class="bosses container">
        <div class="boss-name">
            <h3>{{ $boss->name }}</h3>
            @if(session()->get('hp'))
            <h3>{{ session()->get('hp') }}</h3>
            @else
                <h3>{{ $boss->hp }}</h3>
            @endif
            <a href="{{ route('attack.first', $boss->id) }}" class="btn btn-danger boss-btn">Damage</a>
        </div>
    </div>

@endsection