{{-- <div class="wrap-icon-section minicart">
    <a href="{{route('shop.cart')}}" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <div class="left-info">
            @if(Cart::count() > 0)
                <span class="index">{{Cart::count()}} items</span>
            @endif
            <span class="title">CART</span>
        </div>
    </a>
</div> --}}
<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{route('shop.cart')}}">
        <img alt="cart" src="{{asset('assets/imgs/theme/icons/icon-cart.svg')}}">
        @if(Cart::instance('cart')->count()>0)
            <span class="pro-count blue">{{Cart::instance('cart')->count()}}</span>
        @endif
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @foreach(Cart::instance('cart')->content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="product-details.html"><img alt="Surfside Media" src="{{asset('assets/imgs/products')}}/{{$item->model->image}}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="product-details.html"></a>{{substr($item->model->name,0,20)}}...</h4>
                        <h4><span>{{$item->qty}} × </span>$ {{$item->model->regular_price}} </h4>
                    </div>
                    {{-- <div class="shopping-cart-delete">
                        <a href="#" wire:click.prevent="deleteCart('{{$item->rowId}}')"><i class="fi-rs-cross-small"></i></a>
                    </div> --}}
                </li>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span>${{Cart::instance('cart')->total()}}</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{route('shop.cart')}}" class="outline">View cart</a>
                <a href="{{url('/checkout')}}">Checkout</a>
            </div>
        </div>
    </div>
</div>
