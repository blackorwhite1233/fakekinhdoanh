<div id="body_wrapper">
  <div class="container">
        <div id="main">
          <div class="block">
              <div class="block_heading"><h2>Lấy lại mật khẩu</h2></div>
                <div class="block_content">
                  <div class="product_form">
                        @if(Session::has('message_forgotpass'))
                             {{ Session::get('message_forgotpass') }}
                        @endif
                        <ul class="parsley-error-list">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                        <form method="post" action="{{URL::to('')}}/home/forgotpass">
                            <div class="input-group">
                              <span class="input-group-addon">Email <font color="red">*</font></span>
                              <input type="text" class="form-control" name="email" value="">
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
                            <button type="submit" class="btn btn-default submit">Lấy lại mật khẩu</button>
                        </form>
                  </div><!-- product_form -->
                </div><!-- block_content -->
            </div><!-- block -->
      </div><!-- main -->
    </div><!-- container -->
</div><!-- body_wrapper -->
