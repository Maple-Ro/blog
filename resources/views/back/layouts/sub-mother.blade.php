@extends('back.layouts.mother')
@section('content')
    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{backAssets('/images/img.jpg')}}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Liutsing</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br/>
                    <!-- sidebar menu -->
                @include('back.layouts.section.sidebar')
                <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                @include('back.layouts.section.menu-footer')
                <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
        @include('back.layouts.section.top-nav')
        <!-- /top navigation -->

            <!-- page content -->
        @yield('b-content')
        <!-- /page content -->

            <!-- footer content -->
        @include('back.layouts.section.footer')
        <!-- /footer content -->
        </div>
    </div>
@endsection