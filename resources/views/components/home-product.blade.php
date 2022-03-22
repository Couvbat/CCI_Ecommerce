<div class="owl-carousel owl-theme">

    @foreach ($products as $key => $product)
        <a href="/product/{{ $product->id }}/{{ $product->slug }}">
            <div class="featured-item">

                <img src="{{ $product->photos[0]->url }}" alt="Item {{ $key }}" width="220" height="206"/>

                <h4>
                @if (strlen($product->name) > 25 && strlen($product->name) < 45)
                    {{ $product->name }}
                @elseif(strlen($product->name) > 45) <!-- Trop de texte -->
                    {{ substr($product->name,0 , 45) }}...
                    @else
                        <br/> {{ $product->name }} <br/>
                    @endif
                </h4>

                <h6>{{ $product->price }}€</h6>

            </div>
        </a>
    @endforeach

</div>
