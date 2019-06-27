
@extends('layouts.head')

@section('content')

    <div class="container shop-container">

        <div class="row text-center">
            <div class="col-md-1">
                <a href=""><h4 class="shop-links">Buy</h4></a>
            </div>
            <div class="col-md-1">
                <a href=""><h4 class="shop-links">Sell</h4></a>
            </div>
        </div>

        <hr>

        @if(session('message') === true)
            <h3 class="success">Success</h3>
        @elseif(session('message') === false)
            <h3 class="error">Error</h3>
        @endif
        <h2 class="text-center">Shop</h2>

        <div class="row shop-items-row">
            <div class="col-md-4">
                <i class="fas fa-crow fa-3x"></i>
                <h4 class="skill-disc">Skill 1</h4>
                <h3>Price: 100 <i class="fas fa-coins"></i></h3>
                <a href="{{ route('shop.buy::default.skill.1') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
            </div>

            <div class="col-md-4">
                <i class="fas fa-bomb fa-3x"></i>
                <h4 class="skill-disc">Skill 2</h4>
                <h3>Price: 500 <i class="fas fa-coins"></i></h3>
                <a href="{{ route('shop.buy::default.skill.2') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
            </div>

            <div class="col-md-4">
                <i class="fab fa-battle-net fa-3x"></i>
                <h4 class="skill-disc">Skill 3</h4>
                <h3>Price: 1000 <i class="fas fa-coins"></i></h3>
                <a href="{{ route('shop.buy::default.skill.3') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
            </div>
        </div>

    </div>

@endsection