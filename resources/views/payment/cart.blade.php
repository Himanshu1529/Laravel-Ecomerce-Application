@extends('layouts.app')
@section('style')

@endsection
@section('content')

<main class="main">
            <div class="page-header text-center" style="background-image: url('client/images/page-header-bg.jpg')">
                <div class="container">
                    <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="cart">
                    <div class="container">
                       @if($cartItems->count() > 0)
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{url('update_cart')}}" method="post">
                                    {{ csrf_field() }}
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($cartItems as $key => $cart)
                                                @php
                                                    $getCartProduct = $cart->product;
                                                @endphp

                                                 @if(!empty($getCartProduct))
                                                    @php
                                                        $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                                                    @endphp
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <a target="blank" href="{{ url($getCartProduct->slug) }}">
                                                                    <img src="{{ $getProductImage->getLogo() }}" alt="Product image">
                                                                </a>
                                                            </figure>

                                                            <h3 class="product-title">
                                                                <a target="blank" href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }} </a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    <td class="price-col">₹{{number_format($cart->total_price,2)}}</td>
                                                    <td class="quantity-col">
                                                        <div class="cart-product-quantity">
                                                            <input type="number" class="form-control" value="{{$cart->quantity}}" min="1" name="cart[{{ $key }}][qty]" max="50" step="1" data-decimals="0" required>


                                                            <input type="hidden" class="form-control" value="{{$cart->id}}" name="cart[{{ $key }}][id]">
                                                        </div>
                                                    </td>
                                                    <td class="total-col">₹{{number_format($cart->total_price * $cart->quantity,2)}}</td>
                                                    <td class="remove-col"><a href="{{ url('cart/delete/'.$cart->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="cart-bottom">
                                        <div class="cart-discount">
                                            <!-- <form action="#">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required placeholder="coupon code">
                                                    <div class="input-group-append">
                                                        <button  class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </form> -->
                                        </div><!-- End .cart-discount -->

                                        <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                    </div>
                                </form>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3>

                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>₹{{number_format($totalPrice,2)}}</td>
                                            </tr>
                                          <!--   <tr class="summary-shipping">
                                                <td>Shipping:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                                    </div>
                                                </td>
                                                <td>₹0.00</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                                    </div>
                                                </td>
                                                <td>₹0.00</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="express-shipping">Express:</label>
                                                    </div>
                                                </td>
                                                <td>₹0.00</td>
                                            </tr>

                                             <tr class="summary-shipping-estimate">
                                                <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                                <td>&nbsp;</td>
                                            </tr> --> 

                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>₹{{number_format($totalPrice,2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <a href="{{url('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                </div>

                                <a href="{{ url('') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            </aside>
                        </div><!-- End .row -->
                        @else
                        <p class="text-center m-2" style="font-size: 28px">Cart is empty !</p>
                        <a href="{{ url('') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        @endif
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        

@section('script')
    <script src="{{ url('client/js/wNumb.js')}}"></script>
    <script src="{{ url('client/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ url('client/js/nouislider.min.js')}}"></script>
    
@endsection

@endsection