@extends('Shop.Layouts.Master')
@section('title')
    Shop | Home
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Dashboard</h1>
    </div>
    <!--End page title-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>

    </div>
    <!--End page content-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#delete', function (e) {
                e.preventDefault();
                let href = this.getAttribute('href');
                if (confirm('Product will be deleted')) {
                    window.location = this.getAttribute('href');
                }
            })
        });
    </script>
@endsection