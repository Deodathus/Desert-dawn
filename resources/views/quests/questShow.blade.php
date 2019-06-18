
@extends('layouts.head')

@section('content')

    <div class="container quest-container">
        @foreach($missions as $mission)
            <div class="row quest-row">
                <div class="col-lg-3 quest-title text-center">
                    <p>{{ $mission->name }}</p>
                    <p class="quest-description">{{ $mission->description }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    <p><i class="fas fa-coins"></i> {{ $mission->reward_gold }}</p>
                    <p><i class="far fa-gem"></i> {{ $mission->reward_gems }}</p>
                    <p><i class="fas fa-angle-double-up"></i> {{ $mission->reward_exp }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    @if($mission->reward_item != 0)
                        <p>
                        <div class="drop-item-div">
                            <img src="/images/item.png" alt="" class="drop-item-mark">
                            <div class="drop-item-info">
                                Name: {{ $mission->item->name }}
                                <span class="{{ $mission->item->rarity->name }}">
                                        {{ $mission->item->rarity->name }}
                                    </span>
                            </div>
                        </div>
                        </p>
                    @endif
                    @if($mission->reward_item_rarity != 0)
                        <p>
                        <div class="drop-card-div">
                            <img src="/images/cards.png" alt="" class="drop-item-mark">
                            <div class="drop-card-info">
                                <span class="drop-card-span {{ $mission->itemRarity->name }}">{{ $mission->itemRarity->name }}</span>
                                <span class="drop-card-span">Min stats: {{ $mission->itemRarity->min_stat_multiply }}</span>
                                <span class="drop-card-span">Max stats: {{ $mission->itemRarity->max_stat_multiply }}</span>
                                {{--                                    <span class="drop-card-span">{{ $quest->itemRarity->skill_amount }}</span>--}}
                            </div>
                        </div>
                        </p>
                    @endif
                </div>
                <div class="col-lg-3 text-center">
                    <a class="btn btn-danger boss-btn" href="">Do It!</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
