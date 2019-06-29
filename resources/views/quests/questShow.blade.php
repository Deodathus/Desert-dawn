
@extends('layouts.head')

@section('content')

    <div class="container quest-container">
        @if (session('mission_error') === true)
            <h3 class="error">
                Mission is already done or you don't have enought energy.
            </h3>
        @endif
        @foreach($missions as $mission)
            <div class="row quest-row">
                <div class="col-lg-3 quest-title text-center">
                    @if($mission->done)
                        <p style="text-decoration:line-through">{{ $mission->name }}</p>
                    @else
                        <p>{{ $mission->name }}</p>
                    @endif
                    <p class="quest-description">{{ $mission->description }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    <p><i class="fas fa-coins"></i> {{ $mission->reward_gold }}</p>
                    <p><i class="far fa-gem"></i> {{ $mission->reward_gems }}</p>
                    <p><i class="fas fa-angle-double-up"></i> {{ $mission->reward_exp }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    @if($mission->reward_item !== 0)
                        <p>
                        <div class="drop-item-div">
                            <img src="/images/item.png" alt="" class="drop-item-mark">
                            <div class="drop-item-info text-left">
                                Name: {{ $mission->item->name }}
                                <span class="{{ $mission->item->rarity->name }}">
                                        {{ $mission->item->rarity->name }}
                                </span>
                                <span class="drop-card-span">Strength: {{ $mission->item->itemAttribute->strength }}</span>
                                <span class="drop-card-span">Stamina: {{ $mission->item->itemAttribute->stamina }}</span>
                                <span class="drop-card-span">Agility: {{ $mission->item->itemAttribute->agility }}</span>
                                <span class="drop-card-span">Intellect: {{ $mission->item->itemAttribute->intellect }}</span>
                                <span class="drop-card-span">Luck: {{ $mission->item->itemAttribute->luck }}</span>
                                <span class="drop-card-span">Wisdom: {{ $mission->item->itemAttribute->wisdom }}</span>
                            </div>
                        </div>
                        </p>
                    @endif
                    @if($mission->reward_item_rarity !== 0)
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
                    <a class="btn btn-danger boss-btn" href="{{ route('mission.done', $mission) }}">Do It! (-{{ $mission->energy_cost }} <i class="fas fa-bolt"></i>)</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
