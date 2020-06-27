<div class="header-top off-white-bg">
    <div class="container">
        <!-- Header Top Right Start -->
        <div class="header-top-right f-right">
            <ul class="header-list-menu right-menu">
                <li class="hidden-xs"><span><i class="fa fa-phone"></i> Ordered before 17:30, shipped today  - Support: (012) 800 456 789</span>
                </li>
                @if (!shop())
                    <li><a href="#"><i class="fa fa-user-circle-o"></i>
                            @if (user())
                                {{user()->name}}
                            @else
                                User
                            @endif
                            &nbsp;
                        </a>
                        <ul class="ht-dropdown ht-account">
                            @if (user())
                                <li><a href="{{route('myAccount')}}">My account</a></li>
                                <li><a href="{{route('logout')}}">Logout</a></li>
                            @else
                                <li><a href="{{route('login')}}">Login</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if (!user())
                    <li><a href="#">&nbsp;&nbsp;<i class="fa fa-wrench"></i>
                            @if (shop())
                                {{shop()->name}}
                            @else
                                Are you a branch owner ?
                            @endif
                            &nbsp;
                        </a>
                        <ul class="ht-dropdown ht-account">
                            @if (shop())
                                <li><a href="{{route('shopHome')}}">Dashboard</a></li>
                                <li><a href="{{route('shopLogout')}}">Logout</a></li>
                            @else
                                <li><a href="{{route('getShopRegister')}}">Register</a></li>
                                <li><a href="{{route('getShopLogin')}}">Login</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
            </ul>
            <!-- Header-list-menu End -->
        </div>
        <!-- Header Top Right End -->
    </div>
    <!-- Container End -->
</div>