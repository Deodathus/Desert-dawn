
@extends('layouts.head')

@section('content')

    <div class="bosses container">
        @foreach($bosses as $boss)
            <div class="boss-block">
                <h2>{{ $boss->name }}</h2>
                <div class="row boss-row-info">
                    <div class="col-lg-2 col-md-2">

                    </div>
                    <div class="col-lg-3 col-md-3 text-center">
                        <p><i class="far fa-heart"></i> {{ $boss->hp }}</p>
                        <p><i class="fas fa-shield-alt"></i> {{ $boss->armor }}</p>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center">
                        <p><i class="fas fa-coins"></i> {{ $boss->reward_gold }}</p>
                        <p><i class="fas fa-angle-double-up"></i> {{ $boss->reward_exp }}</p>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <p class="font-weight-bold">Reward:</p>
                        <p> <i class="fas fa-coins"></i>{{ $boss->reward_gold }}
                            <i class="fas fa-angle-double-up"></i>{{ $boss->reward_exp }}
                        </p>
                    </div>
                    <div class="col-lg-1 col-lg-1">
                        <a class="btn btn-danger boss-btn" href="{{ route('boss.show', $boss->id) }}">Attack!</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
