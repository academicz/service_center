@extends('User.Layouts.Master')
@section('contents')
    @include('User.Includes.home_slider')
    <!-- Slider Area End -->
    <!-- Slider Under Main Wrapper Content Start -->
    <div class="slider-under-content pb-50">
        <div class="container">
            <div class="row">
                <div class="company-policy pb-50">
                    <div class="container">
                        <div class="main-policy">
                            <div class="row">
                                <!-- Single Policy Start -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="policy-conditions">
                                        <div class="single-policy po-1">
                                            <div class="policy-desc">
                                                <h3>Free Delivery</h3>
                                                <p>Free shipping on all order</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Policy End -->
                                <!-- Single Policy Start -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="policy-conditions">
                                        <div class="single-policy po-2">
                                            <div class="policy-desc">
                                                <h3>Online Support 24/7</h3>
                                                <p>Support online 24 hours</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Policy End -->
                                <!-- Single Policy Start -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="policy-conditions">
                                        <div class="single-policy po-3">
                                            <div class="policy-desc">
                                                <h3>Money Return</h3>
                                                <p>Back guarantee under 7 days</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Policy End -->
                                <!-- Single Policy Start -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="policy-conditions">
                                        <div class="single-policy po-4">
                                            <div class="policy-desc">
                                                <h3>Member Discount</h3>
                                                <p>Onevery order over $30.00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Policy End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="deal deal-two border-default universal-padding mb-50">
                        <div class="group-title">
                            <h2>SHOPS</h2>
                        </div>
                        <!-- Deal Pro Activation Start -->
                        <div class="deal-pro-active deal-pro-style-two">
                            @foreach ($serviceCenters as $serviceCenter)
                                <div class="single-product mb-20" style="border-bottom: 1px dashed #ccc">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-5 col-xs-4">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">
                                                    <img src="{{ privateAsset($serviceCenter->shop_images->first()->image_path) }}"
                                                         alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                        </div>
                                        <div class="col-md-8 col-sm-7 col-xs-8">
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h3>
                                                    <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">{{$serviceCenter->name}}</a>
                                                </h3>
                                                {{--<div class="product-rating">--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--</div>--}}
                                                <p>
                                                    <span class="price">{{ $serviceCenter->address.', '.$serviceCenter->place }}</span>
                                                </p>
                                                <p>{{$serviceCenter->description}}</p>
                                                <div class="home-2-pro-actions">
                                                    <div class="actions-primary">
                                                        <a href="{{route('getRequestService',['id'=>$serviceCenter->id])}}"
                                                           data-toggle="tooltip" title="Request Service">Request
                                                            Service</a>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- Deal Pro Activation End -->
                    </div>
                    <!-- Single Banner Start -->

                    <!-- Single Banner End -->

                    <!-- New Pro Content End -->
                    <div class="new-pro-content border-default new-products mb-50 home-2-actions">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Featured Product List Item Start -->
                                <ul class="product-list product-tab-list universal-margin mb-30">
                                    @foreach(categories() as $type)
                                        <li @if ($loop->iteration==1)
                                            class="active"
                                                @endif><a data-toggle="tab"
                                                          href="#n{{$type->id}}">{{$type->shop_type}}</a></li>
                                    @endforeach
                                </ul>
                                <!-- Featured Product List Item End -->
                            </div>
                        </div>
                        <div class="tab-content product-tab-content">
                            @foreach(categories() as $type)
                                <div id="n{{$type->id}}" class="tab-pane fade in active">
                                    <!-- New Products Activation Start -->
                                    <div class="home-2-new-pro-active home-2-new-customize owl-carousel">
                                        <!-- Single Product Start -->
                                        @foreach($type->service_center as $serviceCenter)
                                            @if ($serviceCenter->status==App\Constants\Constants::$APPROVED_CENTER)
                                                <div class="single-product">
                                                    <!-- Product Image Start -->
                                                    <div class="pro-img">
                                                        <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">
                                                            <img class="primary-img"
                                                                 src="{{ privateAsset($serviceCenter->shop_images->first()->image_path) }}"
                                                                 alt="single-product">
                                                        </a>
                                                    </div>
                                                    <!-- Product Image End -->
                                                    <!-- Product Content Start -->
                                                    <div class="pro-content">
                                                        <h4>
                                                            <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">{{$serviceCenter->name}}</a>
                                                        </h4>
                                                        <p>
                                                            <span class="price">{{$serviceCenter->address.', '.$serviceCenter->place}}</span>
                                                        </p>
                                                        <div class="pro-actions">
                                                            <div class="actions-primary">
                                                                <a href="{{route('getRequestService',['id'=>$serviceCenter->id])}}"
                                                                   data-toggle="tooltip"
                                                                   title="Request Service">Request Service</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Product Content End -->
                                                </div>
                                            @endif
                                    @endforeach
                                    <!-- Single Product End -->
                                        <!-- Single Product Start -->

                                    </div>
                                    <!-- New Products Activation End -->
                                </div>
                        @endforeach
                        <!-- #Featured Products End -->
                        </div>
                        <!-- Tab-Content End -->
                    </div>
                    <!-- New Pro Content End -->
                    <!-- Single Banner Start -->
                    <!-- Single Banner End -->
                    <!-- Best Selling Product Start -->
                    <!-- Best Selling Product End -->
                </div>

            </div>

        </div>
    </div>
    <!-- Slider Under Main Wrapper Content End -->

    <!-- Company Policy Start -->
    <!-- Company Policy End -->
@stop