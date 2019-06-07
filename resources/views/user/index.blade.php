
@extends('layouts.head')

@section('content')

    <div class="container user-hero-container">

        <h2>{{ Auth::user()->name }}'s attributes</h2>
        <div class="row">
            <div class="col-lg-4 col-md-4">

                <div class="hero-attributes">
                    <p class="user-attribute">
                        Strength:
                        {{ Auth::user()->attributes->strength }}
                    </p>
                    <p class="user-attribute">
                        Stamina:
                        {{ Auth::user()->attributes->stamina }}
                    </p>
                    <p class="user-attribute">
                        Agility:
                        {{ Auth::user()->attributes->agility }}
                    </p>
                    <p class="user-attribute">
                        Intellect:
                        {{ Auth::user()->attributes->intellect }}
                    </p>
                    <p class="user-attribute">
                        Luck:
                        {{ Auth::user()->attributes->luck }}
                    </p>
                    <p class="user-attribute">
                        Wisdom:
                        {{ Auth::user()->attributes->wisdom }}
                    </p>
                </div>

                <h2>Attributes from cards:</h2>

                <div class="hero-attributes">
                    <p class="user-attribute">
                        Strength:
                        {{ $attributes['strength'] }}
                    </p>
                    <p class="user-attribute">
                        Stamina:
                        {{ $attributes['stamina'] }}
                    </p>
                    <p class="user-attribute">
                        Agility:
                        {{ $attributes['agility'] }}
                    </p>
                    <p class="user-attribute">
                        Intellect:
                        {{ $attributes['intellect'] }}
                    </p>
                    <p class="user-attribute">
                        Luck:
                        {{ $attributes['luck'] }}
                    </p>
                    <p class="user-attribute">
                        Wisdom:
                        {{ $attributes['wisdom'] }}
                    </p>
                </div>
            </div>



            <div class="col-lg-8 col-md-8">
                @if(session('error'))
                    <h1 class="card-error">6 cards are already active.</h1>
                @endif
                <h2>Active cards:</h2>
                <div class="items row">
                    @foreach($activeCards as $item)
                            <div class="col-lg-5 col-md-5 card-div text-center">
                                <form action="{{ route('item.change.status', $item) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <input type="checkbox" class="card-checkbox" value="{{ $item->id }}" onChange="this.form.submit()" checked>
                                    <img src="images/{{ $item->rarity->name }}.png" alt="">
                                    <p class="user-attribute">
                                        {{ $item->name }}
                                    </p>
                                    <div class="card-info text-left">
                                        <p class="{{ $item->rarity->name }} card-attribute">{{ $item->rarity->name }}</p>
                                        <a class="card-attribute {{ $item->rarity->name }}" href="#">{{ $item->name }}</a>
                                        <p class="card-attribute">Strength: {{ $item->itemAttribute->strength }}</p>
                                        <p class="card-attribute">Stamina: {{ $item->itemAttribute->stamina }}</p>
                                        <p class="card-attribute">Agility: {{ $item->itemAttribute->agility }}</p>
                                        <p class="card-attribute">Intellect: {{ $item->itemAttribute->intellect }}</p>
                                        <p class="card-attribute">Luck: {{ $item->itemAttribute->luck }}</p>
                                        <p class="card-attribute">Wisdom: {{ $item->itemAttribute->wisdom }}</p>
                                    </div>
                                </form>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row not-active-cards">
            <h2>Deactivated cards:</h2>
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    @foreach($notActiveCards as $item)
                        <div class="card-div text-center">
                            <form action="{{ route('item.change.status', $item) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                <input type="checkbox" class="card-checkbox" value="{{ $item->id }}" onChange="this.form.submit()">
                                <img src='images/{{ $item->rarity->name }}.png' alt="">
                                <p class="user-attribute">
                                    {{ $item->name }}
                                </p>
                                <div class="card-info text-left">
                                    <p class="{{ $item->rarity->name }} card-attribute">{{ $item->rarity->name }}</p>
                                    <a class="card-attribute {{ $item->rarity->name }}" href="#">{{ $item->name }}</a>
                                    <p class="card-attribute">Strength: {{ $item->itemAttribute->strength }}</p>
                                    <p class="card-attribute">Stamina: {{ $item->itemAttribute->stamina }}</p>
                                    <p class="card-attribute">Agility: {{ $item->itemAttribute->agility }}</p>
                                    <p class="card-attribute">Intellect: {{ $item->itemAttribute->intellect }}</p>
                                    <p class="card-attribute">Luck: {{ $item->itemAttribute->luck }}</p>
                                    <p class="card-attribute">Wisdom: {{ $item->itemAttribute->wisdom }}</p>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection