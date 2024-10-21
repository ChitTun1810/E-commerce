<div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{route('home.index')}}"><img src="{{asset('assets/imgs/logo/logo1.png')}}" alt="logo"></a>
                </div>
                <div class="header-right">
                    @livewire('header-search-component')
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{route('coupon')}}"><i class="fa-solid fa-gift"></i></a>
                            </div>
                            @livewire('wishlist-icon-component')
                            @livewire('cart-icon-component')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
