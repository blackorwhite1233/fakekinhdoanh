<!DOCTYPE html>
<html lang="en">
    <title><?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.$page['pageNote']. " | ". CNF_APPNAME : CNF_APPNAME ;?></title>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="{{ CNF_METAKEY }}">
    <meta name="description" content="{{ CNF_METADESC }}">
    <link rel="shortcut icon" href="{{ URL::to('')}}/logo.ico" type="image/x-icon"> 

    <!-- Bootstrap -->
    {{ HTML::style('sximo/themes/uber/css/bootstrap.min.css')}}
    {{ HTML::style('sximo/themes/uber/css/bootstrap-theme.min.css')}}
    {{ HTML::style('sximo/themes/uber/css/style.css')}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    {{ HTML::script('sximo/themes/uber/js/jquery.min.js') }}   
    {{ HTML::script('sximo/themes/uber/js/bootstrap.min.js') }}  
    {{ HTML::script('sximo/themes/uber/js/jquery.carouFredSel.js') }}  


  </head>
	<body>
	<header id="header">
    	<div class="container">
            <div id="logo"><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/uber/image/logo.png')}}"></a></div>
            @include('layouts/uber/topbar')
            
         </div><!-- container -->
	</header>
    <nav id="nav">
    	<div class="container">
        	<ul class="menu">
            	<li><a href="{{URL::to('')}}"><img src="{{ asset('sximo/themes/uber/image/home-icon.png')}}"></a></li>
                <li><a href="{{URL::to('')}}/tin-moi-dang.html">Tin mới đăng</a></li>
                <li><a href="{{URL::to('')}}/hanh-khach.html">Hành khách</a></li>
                <li><a href="{{URL::to('')}}/tai-xe.html">Tài xế</a></li>
            </ul>
            <ul class="member-area">
                @if(Session::has('customer'))
                    {{--*/ $ses_cus = Session::get('customer'); /*--}}
                    <li class="user-panel">{{$ses_cus['username']}} 
                        <ul>
                        	<li><a href="{{URL::to('tin-da-dang.html')}}">Các tin đã đăng</a></li>
                        	<li><a href="{{URL::to('thong-tin-thanh-vien.html')}}">Thông tin</a></li>
                            <li><a href="{{URL::to('change-pass.html')}}">Đổi mật khẩu</a></li>
                            <li><a href="{{URL::to('change-info.html')}}">Thay đổi thông tin tài khoản</a></li>
                            <li><a href="{{URL::to('home/logout')}}">Thoát</a></li>
                        </ul>
                    </li>
                    <li class="post-thread"   ><a href="{{URL::to('dang-tin.html')}}">Đăng tin</a></li>
                @else
                    <!--<li ><a href="#" data-toggle="modal" data-target="#login-box">Đăng nhập</a></li>-->
                    <li @if(isset($menu) && $menu == "dangky") class="post-thread" @endif ><a href="{{URL::to('dang-ky.html')}}">Đăng ký</a></li>
                    <li class="post-thread" @if(!Session::has('customer')) data-toggle="modal" data-target="#login-box" @endif ><a href="#">Đăng tin</a></li>
                @endif
                
            </ul>
        </div><!-- container -->
    </nav>

    <section id="slider">
    	<div class="container clearfix">
        @include('layouts/uber/slide')
        
        </div>
    </section>
    @if(isset($menu) && $menu == "index" )
      @include('layouts/uber/timkiem')
    @endif
    <main id="main">
    	{{$content}}
    </main>
     @if(isset($menu) && ($menu == "index" || $menu == "tinhthanh"))
      @include('layouts/uber/tinhthanh')
    @endif
    <footer id="footer">
        @if(!Session::has('customer'))
        <div class="modal fade" id="login-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
                                    $(".error_login").html('Sai tên mật khẩu hoặc mật khẩu !');
                                }
                              });
                        }
                    });
                });
            </script>
            <div class="column right">
                <p>Hoặc bạn có thể đăng nhập bằng tài khoản facebook</p>
                <a href="{{URL::to('user/facebook')}}"><img src="{{ asset('sximo/themes/uber/image/loginfb.png')}}"></a>
            </div><!-- colum -->
          </div>
          <div class="modal-footer">
            <ul>
                <li>Quên mật khẩu? <a href="{{URL::to('')}}/forgotpass.html">Lấy lại mật khẩu</a></li>
                <li>Chưa có tài khoản? <a href="{{URL::to('')}}/dang-ky.html">Đăng ký</a></li>
            </ul>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- Modal -->
    @endif
    	<div class="container clearfix">
        	<div class="site-info">
            	<h2>DichvuUBER.com</h2>
                <p>{{CNF_FOOTER}}<br>
            </div><!-- site-info -->
            <div class="social-links">
            	<a href="@if(CNF_fb != '') {{CNF_fb}} @else # @endif" class="fb"><img src="{{ asset('sximo/themes/uber/image/social-fb.png')}}"></a>
                <a href="@if(CNF_gg != '') {{CNF_gg}} @else # @endif" class="gp"><img src="{{ asset('sximo/themes/uber/image/social-gp.png')}}"></a>
                <a href="@if(CNF_tw != '') {{CNF_tw}} @else # @endif" class="tw"><img src="{{ asset('sximo/themes/uber/image/social-tw.png')}}"></a>
            </div>
        </div><!-- container -->
    </footer>
  </body>
</html>