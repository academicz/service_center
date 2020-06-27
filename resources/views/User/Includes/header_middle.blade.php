<div class="header-middle-two header-middle white-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 hidden-xs">
                <!-- Logo Start -->
                <div class="logo-style-two logo pull-left">
                    <a href="{{route('home')}}"><h1 style="color: #fff;margin: 0">E<span
                                    style="color: #0f80db;font-size: 35px"><sub>2</sub></span>CARE</h1></a>
                </div>
                <!-- Logo End -->
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="search-box-style-two search-box-view fix">
                    <form action="{{route('search')}}">
                        <input type="text" class="email" placeholder="Search for shop..." name="key">
                        <button type="submit" class="submit"></button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="cart-style-two cart-box text-right">
                    <ul>
                        @if (user())
                            <li><a href="#"><i class="fa fa-bell"></i><span
                                            class="cart-counter">{{user()->login->unreadNotifications()->count()}}</span></a>
                                <ul class="ht-dropdown fa fa-pencil">
                                    <li>
                                        <!-- Cart Box Start -->
                                        @foreach (user()->login->notifications as $notification)
                                            <div class="single-cart-box">
                                                <strong><a href="{{route('myAccount')}}">{{$notification->data["message"]}}</a></strong>
                                            </div>
                                        <?php $notification->markAsRead();?>
                                    @endforeach
                                    <!-- Cart Footer Inner End -->
                                    </li>
                                </ul>
                            </li>
                        @endif
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
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>