
@extends('layouts.head')

@section('content')

    <div class="container quest-container">
            @foreach($quests as $quest)
            <div class="row quest-row">
                <div class="col-lg-3 quest-title text-center">
                    @if($quest->done)
                        <p style="text-decoration:line-through">{{ $quest->name }}</p>
                    @else
                        <p>{{ $quest->name }}</p>
                    @endif
                    <p class="quest-description">{{ $quest->description }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    <p><i class="fas fa-coins"></i> {{ $quest->reward_gold }}</p>
                    <p><i class="far fa-gem"></i> {{ $quest->reward_gems }}</p>
                    <p><i class="fas fa-angle-double-up"></i> {{ $quest->reward_exp }}</p>
                </div>
                <div class="col-lg-3 text-center">
                    @if($quest->reward_item != 0)
                        <p>
                            <div class="drop-item-div">
                                <img src="/images/item.png" alt="" class="drop-item-mark">
                                <div class="drop-item-info text-left">
                                    Name: {{ $quest->item->name }}
                                    <span class="{{ $quest->item->rarity->name }}">
                                            {{ $quest->item->rarity->name }}
                                    </span>
                                    <span class="drop-card-span">Strength: {{ $quest->item->itemAttribute->strength }}</span>
                                    <span class="drop-card-span">Stamina: {{ $quest->item->itemAttribute->stamina }}</span>
                                    <span class="drop-card-span">Agility: {{ $quest->item->itemAttribute->agility }}</span>
                                    <span class="drop-card-span">Intellect: {{ $quest->item->itemAttribute->intellect }}</span>
                                    <span class="drop-card-span">Luck: {{ $quest->item->itemAttribute->luck }}</span>
                                    <span class="drop-card-span">Wisdom: {{ $quest->item->itemAttribute->wisdom }}</span>
                                </div>
                            </div>
                        </p>
                    @endif
                    @if($quest->reward_item_rarity != 0)
                        <p>
                            <div class="drop-card-div">
                                <img src="/images/cards.png" alt="" class="drop-item-mark">
                                <div class="drop-card-info">
                                    <span class="drop-card-span {{ $quest->itemRarity->name }}">{{ $quest->itemRarity->name }}</span>
                                    <span class="drop-card-span">Min stats: {{ $quest->itemRarity->min_stat_multiply }}</span>
                                    <span class="drop-card-span">Max stats: {{ $quest->itemRarity->max_stat_multiply }}</span>
{{--                                    <span class="drop-card-span">{{ $quest->itemRarity->skill_amount }}</span>--}}
                                </div>
                            </div>
                        </p>
                    @endif
                </div>
                <div class="col-lg-3 text-center">
                    <span class="drop-card-span"><a class="btn btn-danger boss-btn" href="{{ route('quest.show', $quest) }}">Go!</a></span>
                    <span class="drop-card-span"><a class="btn btn-danger boss-btn" href="{{ route('quest.get.reward', $quest) }}">Get reward!</a></span>
                </div>
            </div>
            @endforeach
    </div>

@endsection
