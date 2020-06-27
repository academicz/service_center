<div class="header-bottom-style-two header-bottom black-bg header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 visible-xs full-col">
                <!-- Logo Start -->
                <div class="logo mt-10">
                    <a href="{{route('home')}}"><img src="{{ asset('user/img/logo/logo2.png') }}" alt="logo-image"></a>
                </div>
                <!-- Logo End -->
            </div>
            <!-- Primary Vertical-Menu Start -->
            <div class="col-sm-12 hidden-xs">
                <!-- Header Middle Menu Start -->
                <div class="middle-menu home-2-mid-menu">
                    <nav>
                        <ul class="middle-menu-list">
                            <li><a href="{{route('home')}}">home</a></li>
                            <li><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                <ul class="ht-dropdown dropdown-style-two">
                                    @foreach(categories() as $type)
                                        <li><a href="{{route('categoryShops',['id'=>$type->id,'name'=>$type->shop_type])}}">{{$type->shop_type}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="shop.html">shops<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    @foreach(shopList() as $shop)
                                        <li><a href="{{route('getServiceCenter',['id'=>$shop->id])}}">{{$shop->name}}</a></li>
                                    @endforeach
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Header Middle Menu End -->
            </div>
            <!-- Primary Vertical-Menu End -->
            <!-- Cartt Box Start -->
            <div class="col-xs-6 full-col fl-r visible-xs">
                <div class="cart-box text-right">
                    <ul>
                        <li><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                        <li><a href="compare.html"><i class="fa fa-signal"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-basket"></i><span class="cart-counter">2</span></a>
                            <ul class="ht-dropdown main-cart-box">
                                <li>
                                    <!-- Cart Box Start -->
                                    <div class="single-cart-box">
                                        <div class="cart-img">
                                            <a href="#"><img src="{{ asset('user/img/menu/1.jpg') }}"
                                                             alt="cart-image"></a>
                                        </div>
                                        <div class="cart-content">
                                            <h6><a href="product.html">Alpha Block Black Polo T-Shirt</a></h6>
                                            <span>1 × $399.00</span>
                                        </div>
                                        <a class="del-icone" href="#"><i class="fa fa-window-close-o"></i></a>
                                    </div>
                                    <!-- Cart Box End -->
                                    <!-- Cart Box Start -->
                                    <div class="single-cart-box">
                                        <div class="cart-img">
                                            <a href="#"><img src="{{ asset('user/img/menu/2.jpg') }}"
                                                             alt="cart-image"></a>
                                        </div>
                                        <div class="cart-content">
                                            <h6><a href="product.html">Red Printed Round Neck T-Shirt</a></h6>
                                            <span>2 × $299.00</span>
                                        </div>
                                        <a class="del-icone" href="#"><i class="fa fa-window-close-o"></i></a>
                                    </div>
                                    <!-- Cart Box End -->
                                    <!-- Cart Footer Inner Start -->
                                    <div class="cart-footer fix">
                                        <h5>total :<span class="f-right">$698.00</span></h5>
                                        <div class="cart-actions">
                                            <a class="checkout" href="checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                    <!-- Cart Footer Inner End -->
                                </li>
                            </ul>
                        </li>
                        <li class="search-bar-xs visible-xs"><a href="#"><i class="fa fa-search"></i></a>
                            <div class="ht-dropdown search-box-view">
                                <form action="#">
                                    <input type="text" class="email" placeholder="Search for item..."
                                           name="email">
                                    <button type="submit" class="submit"></button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Cartt Box End -->
            <!-- Mobile Menu  Start -->
            <div class="col-xs-12">
                <div class="mobile-menu mobile-menu-two visible-xs">
                    <nav>
                        <ul>
                            <li><a href="index.html">home</a>
                                <!-- Home Version Dropdown Start -->
                                <ul>
                                    <li><a href="index.html">Home Version 1</a></li>
                                    <li><a href="index-2.html">Home Version 2</a></li>
                                    <li><a href="index-3.html">Home Version 3</a></li>
                                    <li><a href="index-4.html">Home Version 4</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="shop.html">shop</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="product.html">product details</a></li>
                                    <li><a href="compare.html">compare</a></li>
                                    <li><a href="cart.html">cart</a></li>
                                    <li><a href="checkout.html">checkout</a></li>
                                    <li><a href="wishlist.html">wishlist</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="blog.html">Blog</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="blog-details.html">blog details</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="#">pages</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="register.html">register</a></li>
                                    <li><a href="404.html">404</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="about.html">about us</a></li>
                            <li><a href="contact.html">contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Mobile Menu  End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>