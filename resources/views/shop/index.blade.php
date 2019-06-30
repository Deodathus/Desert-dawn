
@extends('layouts.head')

@section('content')

    <div class="container shop-container"
         data-change-shop-url="{{ route('shop.get.type') }}"
    >

        <div class="row text-center">
            <div class="col-md-1">
                <a href="javascript:void(0)"><h4 class="shop-links" data-shop-id="1">Buy</h4></a>
            </div>
            <div class="col-md-1">
                <a href="javascript:void(0)"><h4 class="shop-links" data-shop-id="2">Sell</h4></a>
            </div>
        </div>

        <hr>

        @if(session('message') === true)
            <h3 class="success">Success</h3>
        @elseif(session('message') === false)
            <h3 class="error">Error</h3>
        @endif

        <div class="shop-content">
            <h2 class="text-center">Skill shop</h2>

            <div class="row shop-items-row">
                <div class="col-md-4">
                    <img src="/images/first.png" alt="">
                    <h4 class="skill-disc">Skill 1</h4>
                    <h3>Price: 100 <i class="fas fa-coins"></i></h3>
                    <a href="{{ route('shop.buy::default.skill.1') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
                </div>

                <div class="col-md-4">
                    <img src="/images/second.png" alt="">
                    <h4 class="skill-disc">Skill 2</h4>
                    <h3>Price: 500 <i class="fas fa-coins"></i></h3>
                    <a href="{{ route('shop.buy::default.skill.2') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
                </div>

                <div class="col-md-4">
                    <img src="/images/third.png" alt="">
                    <h4 class="skill-disc">Skill 3</h4>
                    <h3>Price: 1000 <i class="fas fa-coins"></i></h3>
                    <a href="{{ route('shop.buy::default.skill.3') }}" class="btn btn-danger boss-btn boss-btn-show">Buy</a>
                </div>
            </div>
        </div>

    </div>

@endsection
