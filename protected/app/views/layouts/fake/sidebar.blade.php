<div id="sidebar">
    <div class="box">
        <div class="box_heading">Danh mục</div>
        <div class="box_content">
            @include('layouts/fake/danhmuctop', array('pos' => 'left'))
        </div><!-- box_content -->
    </div><!-- box -->
    <div class="box">
        <div class="box_content">
            <img src="{{ asset('sximo/themes/fake/images/banner-support.jpg')}}">
        </div><!-- box_content -->
    </div><!-- box -->
    <div class="box">
        <div class="box_heading">Quảng cáo</div>
        @include('layouts/fake/advertise_left')
    </div><!-- box -->
</div><!-- sidebar -->