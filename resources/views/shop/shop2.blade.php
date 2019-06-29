<h3 id="response" class="success"></h3>

<h2 class="text-center">Sell your useless items.</h2>

<div class="row shop-items-row">
    @foreach($items as $item)
      <div class="col-md-3 item-shop-div">
          <div class="item-shop-img">
              <img src="/images/{{ $item->rarity->name }}.png" alt="">

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
          </div>
          <p>
              <span>Name:</span> {{ $item->name }}
          </p>
          <p>
              <span>Rarity:</span> {{ $item->rarity->name }}
          </p>
          <p>
              <span>Price:</span> Item cost
          </p>
          <a href="javascript:void(0)" data-item-selling-url="{{ route('shop.sell', $item) }}" class="btn btn-danger boss-btn boss-btn-show item-sell">Sell</a>
      </div>
    @endforeach
</div>
