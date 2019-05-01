
@extends('layouts.head')

@section('content')


    <div class="container user-hero-container">

        <h2>{{ Auth::user()->name }}</h2>
        <div class="row">
            <div class="col-lg-4 col-md-4">

                <div class="hero-attributes">
                    <p class="user-attribute">
                        Strength:
                        {{ Auth::user()->attributes->first()->strength }}
                    </p>
                    <p class="user-attribute">
                        Stamina:
                        {{ Auth::user()->attributes->first()->stamina }}
                    </p>
                    <p class="user-attribute">
                        Agility:
                        {{ Auth::user()->attributes->first()->agility }}
                    </p>
                    <p class="user-attribute">
                        Intellect:
                        {{ Auth::user()->attributes->first()->intellect }}
                    </p>
                    <p class="user-attribute">
                        Luck:
                        {{ Auth::user()->attributes->first()->luck }}
                    </p>
                    <p class="user-attribute">
                        Wisdom:
                        {{ Auth::user()->attributes->first()->wisdom }}
                    </p>
                </div>
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="items row">
                    @foreach(Auth::user()->items as $item)
                            <div class="col-lg-5 col-md-5 card-div text-center">
                                <img src="images/legendaryCard.png" alt="">
                                <p class="user-attribute">
                                    {{ $item->name }}
                                </p>
                                <div class="card-info text-left">
                                    <p class="{{ $item->rarity->name }}">{{ $item->rarity->name }}</p>
                                    <p>{{ $item->name }}</p>
                                    <p>Stamina: {{ $item->itemAttribute->stamina }}</p>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection