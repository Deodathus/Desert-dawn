
@extends('layouts.head')

@section('content')

    <div class="level-up-section text-center">
        <h3>
            Recived item:
        </h3>

        <div class="item-reward-img">
            <img src="images/{{ $rewardCard->rarity->name }}.png" alt="">

            <div class="card-info text-left">
                <p class="{{ $rewardCard->rarity->name }} card-attribute">{{ $rewardCard->rarity->name }}</p>
                <a class="card-attribute {{ $rewardCard->rarity->name }}" href="#">{{ $rewardCard->name }}</a>
                <p class="card-attribute">Strength: {{ $rewardCard->itemAttribute->strength }}</p>
                <p class="card-attribute">Stamina: {{ $rewardCard->itemAttribute->stamina }}</p>
                <p class="card-attribute">Agility: {{ $rewardCard->itemAttribute->agility }}</p>
                <p class="card-attribute">Intellect: {{ $rewardCard->itemAttribute->intellect }}</p>
                <p class="card-attribute">Luck: {{ $rewardCard->itemAttribute->luck }}</p>
                <p class="card-attribute">Wisdom: {{ $rewardCard->itemAttribute->wisdom }}</p>
            </div>
        </div>

        <p class="user-attribute">
            {{ $rewardCard->name }}
        </p>

        <a href="{{ route('boss.index') }}" class="btn btn-primary">Boss Page</a>
    </div>

@endsection