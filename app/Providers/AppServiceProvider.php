<?php

namespace App\Providers;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
  use Illuminate\View\View;
  use Illuminate\Support\Facades;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Chia sẻ biến Session('cart') cho các view header.blade.php và checkout.blade.php
    Facades\View::composer(['layout.header','banhang.checkout'], function (View $view) {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart'); // session cart được tạo trong method addToCart của PageController
            $cart = new Cart($oldCart);
            $view->with([
                'cart' => Session::get('cart'),
                'productCarts' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty
            ]);
        }
    });
}
}