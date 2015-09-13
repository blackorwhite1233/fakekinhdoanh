<div id="body_wrapper">
  <div class="container">
        <div id="main">
          <div class="block">
              <div class="block_heading"><h2>Thay đổi mật khẩu</h2></div>
                <div class="block_content">
                  <div class="product_form">
                       @if(Session::has('message_changepass'))
                             {{ Session::get('message_changepass') }}
                        @endif
                        <ul class="parsley-error-list">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        <form method="post" action="{{URL::to('home/changepass')}}">
                            <div class="input-group">
                              <span class="input-group-addon">Mật khẩu cũ</span>
                              <input  type="password" class="form-control" name="password"  >
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Mật khẩu mới</span>
                              <input type="password" class="form-control" name="newpassword">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Nhập lại mật khẩu mới</span>
                              <input type="password" class="form-control" name="confirmpassword">
                            </div>
                            @if(CNF_RECAPTCHA =='true')
                            <div class="box info-user">
                              <label>Mã bảo mật</label>
                              <table>
                                  <tr><td>  

                                {{ Form::captcha(array('theme' => 'white')); }}

                              </td></tr>
                                </table>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-default submit">Thay đổi mật khẩu</button>
                        </form>
                  </div><!-- product_form -->
                </div><!-- block_content -->
            </div><!-- block -->
      </div><!-- main -->
    </div><!-- container -->
</div><!-- body_wrapper -->
