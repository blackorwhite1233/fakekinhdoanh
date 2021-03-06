<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.$page['pageNote']. " | ". CNF_APPNAME : CNF_APPNAME ;?></title>
    <meta name="keywords" content="{{ CNF_METAKEY }}">
    <meta name="description" content="{{ CNF_METADESC }}">
    <link rel="shortcut icon" href="{{ URL::to('')}}/logo.ico" type="image/x-icon">

    {{ HTML::style('sximo/themes/fake/fonts/fonts.css')}}
    {{ HTML::style('sximo/themes/fake/css/bootstrap.min.css')}}
    {{ HTML::style('sximo/themes/fake/css/font-awesome.min.css')}}
    {{ HTML::style('sximo/themes/fake/css/slick.css')}}
    {{ HTML::style('sximo/themes/fake/css/style.css')}}
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    {{ HTML::script('sximo/themes/fake/js/jquery.min.js') }}
    {{ HTML::script('sximo/themes/fake/js/bootstrap.min.js') }}
    {{ HTML::script('sximo/themes/fake/js/slick.min.js') }}
    {{ HTML::script('sximo/themes/fake/js/jquery.matchHeight-min.js') }}
</head>

<body>
<div id="header">
    <div class="container">
        <div id="logo"><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/fake/images/logo.png')}}"></a></div>
        <div class="cat_list">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Danh mục sản phẩm <span class="caret"></span>
              </button>
              @include('layouts/fake/danhmuctop', array('pos' => 'top'))
            </div>
        </div><!-- cat_list -->
        <div class="search">
            <form>
            <input class="search_input" type="text" value="" >
            <button class="search_submit"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- search -->
        <div class="member_area">
            @if(Session::has('customer'))
                {{--*/ $ses_cus = Session::get('customer'); /*--}}
                <a class="username" href="{{URL::to('san-pham-da-dang.html')}}"><img src="@if($ses_cus['image'] == "") {{ asset('sximo/themes/fake/images/avatar.jpg')}} @else {{URL::to('uploads/customer/thumb')}}/{{$ses_cus['image']}} @endif">{{$ses_cus['username']}}</a>
                <a href="{{URL::to('dang-san-pham.html')}}" class="product_submit">Đăng sản phẩm</a>
            @else
                <a href="#" class="login" data-toggle="modal" data-target="#login-box">Đăng nhập</a>
                <a href="{{URL::to('dang-ky.html')}}" class="register_button">Đăng ký thành viên</a>
            @endif
        </div><!-- member_area -->
    </div><!-- container -->
</div><!-- header -->
{{$content}}
<div id="body_bottom">
    <div class="container clearfix">
        <div class="infomation">
            <h2>Facekinhdoanh</h2>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </div><!-- infomation -->
        <div class="contact_info">
            <ul>
                <li><i class="fa fa-home"></i><span>31 Nguyễn Chí Thanh, P.25, Quận 1, Tp.HCM</span></li>
                <li><i class="fa fa-phone"></i><span>(08) 123 5412</span></li>
                <li><i class="fa fa-envelope"></i><span>facekinhdoanh@gmail.com</span></li>
            </ul>
        </div><!-- contact_info -->
    </div><!-- container -->
</div><!-- body_bottom -->
<div id="footer">
    <div class="container clearfix">
        <div class="links">
            <a href="#">Trang chủ</a> |
            <a href="#">Giới thiệu</a> |
            <a href="#">Liên hệ</a>
        </div><!-- links -->
        <div class="social_links">
            <a href="#"><i class="fa fa-facebook-square"></i></a>
            <a href="#"><i class="fa fa-twitter-square"></i></a>
            <a href="#"><i class="fa fa-google-plus-square"></i></a>
        </div><!-- social_links -->
    </div><!-- container -->
</div><!-- footer -->
@if(!Session::has('customer'))
<div class="modal fade" id="login-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
        <p>Vui lòng đăng nhập để đăng bài</p>
      </div>
      <div class="modal-body">
        <div class="column left">
            <div class="error_login"></div>
            <div class="input-group">
                <input type="text" class="form-control" id="username" placeholder="Tài khoản">
            </div>
            <div class="input-group">
                <input type="password" id="password" class="form-control" placeholder="Mật khẩu">
            </div>
            <div class="input-group remember">
                <input type="checkbox" id="remember-acc">
                <label for="remember-acc">Ghi nhớ?</label>
            </div>
            <div class="input-group">
                <input class="btn btn-default submit" type="submit" id="btn_login" value="Đăng nhập">
            </div>
        </div><!-- colum -->
      </div>
      <div class="modal-footer">
        <ul>
            <li>Quên mật khẩu? <a href="{{URL::to('forgotpass.html')}}">Lấy lại mật khẩu</a></li>
            <li>Chưa có tài khoản? <a href="{{URL::to('dang-ky.html')}}">Đăng ký</a></li>
        </ul>
      </div>
      <script type="text/javascript">
                $(document).ready(function() {
                    $("#btn_login").click(function(event) {
                        var us = $("#username").val();
                        var pw = $("#password").val();
                        if(us == '' || pw == ''){
                            $(".error_login").html('Vui Lòng nhập tài khoản và mật khẩu !');
                        }else{
                            var link = "{{URL::to('home/dangnhapajax')}}";
                            $.post(link,{'username':us,'password':pw},function(data,status){
                                if(data == 1){
                                    var uri = "{{$_SERVER['REQUEST_URI']}}";
                                    window.location.href = "{{URL::to('')}}"+uri;
                                }else{
                                    $(".error_login").html('Sai tên đăng nhập hoặc mật khẩu !');
                                }
                              });
                        }
                    });
                });
            </script>
    </div>
  </div>
</div>
@endif
<script>
    $('.slider').slick({
        dots: true,
      infinite: true
    });
     $('.product_list > div').matchHeight();
</script>
</body>
</html>
