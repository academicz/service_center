@extends('User.Layouts.Master')
@section('contents')
    <!-- Slider Area End -->
    <!-- Slider Under Main Wrapper Content Start -->
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active"><a href="#">Service Centes</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pb-50">
        <div class="container">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-sm-5">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        @foreach($serviceCenter->shop_images as $shopImage)
                            <div id="thumb{{$shopImage->id}}" class="tab-pane fade in @if ($loop->iteration==1)
                                    active
@endif">
                                <a data-fancybox="images"
                                   href="{{privateAsset($shopImage->image_path)}}"><img
                                            src="{{privateAsset($shopImage->image_path)}}"
                                            alt="product-view"></a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Thumbnail Large Image End -->

                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail">
                        <div class="thumb-menu owl-carousel">
                            @foreach($serviceCenter->shop_images as $shopImage)
                                <div @if ($loop->iteration==1)
                                     class="active"
                                    @endif>
                                    <a data-toggle="tab" href="#thumb{{$shopImage->id}}"> <img src="{{privateAsset($shopImage->image_path)}}"
                                                                              alt="product-thumbnail"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-sm-7">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{{$serviceCenter->name}}</h3>
                        <div class="rating-summary fix mtb-10">
                            {{--<div class="rating-feedback f-left">--}}
                                {{--<a href="#">(1 review)</a>--}}
                                {{--<a href="#">add to your review</a>--}}
                            {{--</div>--}}
                        </div>
                        <div class="pro-price mb-10">
                            <p><span class="price">{{$serviceCenter->address}}</span>
                            </p>
                        </div>
                        <div class="pro-ref mb-15">
                            <p><span class="in-stock">{{$serviceCenter->place}}</span>
                            </p>
                        </div>
                        <div class="box-quantity">
                            <form action="#">
                                <a class="add-cart" href="{{route('getRequestService',['id'=>$serviceCenter->id])}}">Request Service</a>
                            </form>
                        </div>
                        <p class="ptb-20">{{$serviceCenter->description}}</p>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>

@stop