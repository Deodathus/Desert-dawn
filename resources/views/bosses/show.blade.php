
@extends('layouts.head')

@section('content')

    <div class="bosses container">
        <div class="row boss-attack-row">
            <div class="boss-name col-lg-3 col-md-3">
                <h3>{{ $boss->name }}</h3>
                <h3>{{ session()->get('hp') }} / {{ $boss->hp }}</h3>
            </div>
            <div class="boss-reward col-lg-3 col-md-3">
                <h3>Reward:</h3>
                <p class="p-reward"><i class="fas fa-coins"></i> {{ $boss->reward_gold }}</p>
                <p class="p-reward"><i class="fas fa-angle-double-up"></i> {{ $boss->reward_exp }}</p>
            </div>
            <div class="boss-attack col-lg-3 col-md-3">
                <div class="skill-div">
                    {{ $user->skill_1 }} <br>
                    <i class="fas fa-ghost fa-3x"></i>
                    <h4 class="skill-disc">Ghost attack</h4>
                    <h4 class="skill-disc">Damage: {{ $user->skill_1_damage + $damageFromCards }}</h4>

                    @if($user->skill_1 > 0)
                    <a href="{{ route('attack.first', $boss->id) }}" class="btn btn-danger boss-btn boss-btn-show">Damage</a>
                        @else
                        <p class="btn btn-danger boss-btn boss-btn-show p-reward">Damage</p>
                    @endif

                </div>

                <div class="skill-div">
                    {{ $user->skill_2 }} <br>
                    <i class="fas fa-book-dead fa-3x"></i>
                    <h4 class="skill-disc">Soul corruption</h4>
                    <h4 class="skill-disc">Damage: {{ $user->skill_2_damage + $damageFromCards }}</h4>

                    @if($user->skill_2 > 0)
                        <a href="{{ route('attack.second', $boss->id) }}" class="btn btn-danger boss-btn boss-btn-show">Damage</a>
                    @else
                        <p class="btn btn-danger boss-btn boss-btn-show p-reward">Damage</p>
                    @endif

                </div>

                <div class="skill-div">
                    {{ $user->skill_3 }} <br>
                    <i class="fas fa-meh-blank fa-3x"></i>
                    <h4 class="skill-disc">Lost of mind control</h4>
                    <h4 class="skill-disc">Damage: {{ $user->skill_3_damage + $damageFromCards }}</h4>

                    @if($user->skill_3 > 0)
                        <a href="{{ route('attack.third', $boss->id) }}" class="btn btn-danger boss-btn boss-btn-show">Damage</a>
                    @else
                        <p class="btn btn-danger boss-btn boss-btn-show p-reward">Damage</p>
                    @endif

                </div>
            </div>

{{--            <div class="boss-attack col-lg-3 col-md-3">--}}
{{--                <div class="skill-div">--}}
{{--                    4 <br>--}}
{{--                    <i class="fas fa-book-dead fa-3x"></i>--}}
{{--                    <h4 class="skill-disc">Test</h4>--}}
{{--                    <h4 class="skill-disc">Damage: 100</h4>--}}
{{--                    <a href="" class="btn btn-danger boss-btn boss-btn-show">Damage</a>--}}
{{--                </div>--}}

{{--                <div class="skill-div">--}}
{{--                    4 <br>--}}
{{--                    <i class="fas fa-ghost fa-3x"></i>--}}
{{--                    <h4 class="skill-disc">Test</h4>--}}
{{--                    <h4 class="skill-disc">Damage: 500</h4>--}}
{{--                    <a href="" class="btn btn-danger boss-btn boss-btn-show">Damage</a>--}}
{{--                </div>--}}

{{--                <div class="skill-div">--}}
{{--                    4 <br>--}}
{{--                    <i class="fas fa-meh-blank fa-3x"></i>--}}
{{--                    <h4 class="skill-disc">Test</h4>--}}
{{--                    <h4 class="skill-disc">Damage: 1000</h4>--}}
{{--                    <a href="" class="btn btn-danger boss-btn boss-btn-show">Damage</a>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
        <div class="boss-static row text-center">
            <div class="col-lg-6 col-md-6 last-damage">TEST</div>
            <div class="col-lg-6 col-md-6">TEST</div>
        </div>
    </div>

@endsection