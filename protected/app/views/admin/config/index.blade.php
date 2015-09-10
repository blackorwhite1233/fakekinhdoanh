{{ HTML::script('sximo/js/plugins/tinymce/jscripts/tiny_mce/jquery.tinymce.js')}}
{{ HTML::script('sximo/js/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js')}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> SXIMO VERSION  <small>{{ Lang::get('core.t_generalsettingsmall'); }}</small></h3>
      </div>
	  
	 
	  <ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
		<li><a href="{{ URL::to('config') }}">{{ Lang::get('core.t_generalsetting'); }}</a></li>
	  </ul>	  
	 
    </div>
 	<div class="page-content-wrapper">   
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	<ul class="nav nav-tabs" >
	  <li class="active"><a href="{{ URL::to('config')}}"> {{ Lang::get('core.tab_siteinfo'); }}  </a></li>
	  <!--<li ><a href="{{ URL::to('config/email') }}" >  {{ Lang::get('core.tab_email'); }} </a></li>
	  <li ><a href="{{ URL::to('config/security') }}" >  {{ Lang::get('core.tab_loginsecurity'); }}  </a></li>
	  <li ><a href="{{ URL::to('config/translation') }}" >  Translation  <sup class="badge " style="background:#5BC0DE" >New </sup> </a></li>-->
	   <li ><a href="{{ URL::to('config/log') }}" >  Clear Cache & Logs  </a></li>
	</ul>	
<div class="tab-content m-t">
  <div class="tab-pane active use-padding" id="info">	
 {{ Form::open(array('url'=>'config/save/', 'class'=>'form-horizontal row')) }}

<div class="col-sm-6">
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appname'); }} </label>
	<div class="col-md-8">
	<input name="cnf_appname" type="text" id="cnf_appname" class="form-control input-sm" required  value="{{ CNF_APPNAME }}" />  
	 </div> 
  </div>  
  
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appdesc'); }} </label>
	<div class="col-md-8">
	<input name="cnf_appdesc" type="text" id="cnf_appdesc" class="form-control input-sm" value="{{ CNF_APPDESC }}" /> 
	 </div> 
  </div>  
  
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_comname'); }} </label>
	<div class="col-md-8">
	<input name="cnf_comname" type="text" id="cnf_comname" class="form-control input-sm" value="{{ CNF_COMNAME }}" />  
	 </div> 
  </div>      

  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_emailsys'); }} </label>
	<div class="col-md-8">
	<input name="cnf_email" type="text" id="cnf_email" class="form-control input-sm" value="{{ CNF_EMAIL }}" /> 
	 </div> 
  </div>   
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.address'); }} </label>
	<div class="col-md-8">
	<input name="cnf_address" type="text" id="cnf_address" class="form-control input-sm" value="{{ CNF_ADDRESS }}" /> 
	 </div> 
  </div>   
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.phone'); }} </label>
	<div class="col-md-8">
	<input name="cnf_phone" type="text" id="cnf_phone" class="form-control input-sm" value="{{ CNF_PHONE }}" /> 
	 </div> 
  </div>
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">Facebook </label>
	<div class="col-md-8">
	<input name="cnf_fb" type="text" id="cnf_phone" class="form-control input-sm" value="{{ CNF_fb }}" /> 
	 </div> 
  </div>
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">Google </label>
	<div class="col-md-8">
	<input name="cnf_gg" type="text" id="cnf_phone" class="form-control input-sm" value="{{ CNF_gg }}" /> 
	 </div> 
  </div>
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">Twiter </label>
	<div class="col-md-8">
	<input name="cnf_tw" type="text" id="cnf_phone" class="form-control input-sm" value="{{ CNF_tw }}" /> 
	 </div> 
  </div>
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4"> Formality Site <br /> </label>
	<div class="col-md-8">
		<select class="form-control" name="cnf_free">
			<option @if(CNF_FREE == 0) selected @endif value="0">Free</option>
			<option @if(CNF_FREE == 1) selected @endif value="1">charge</option>
		</select>
	 </div> 
  </div>
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">Price for a post </label>
	<div class="col-md-8">
	<input name="cnf_pricepost" type="text" id="cnf_pricepost" class="form-control input-sm" value="{{ CNF_PRICEPOST }}" /> 
	 </div> 
  </div>
  <!--<div class="form-group">
    <label for="ipt" class=" control-label col-md-4"> Muliti language <br /> <small> Only Layout Interface </small> </label>
	<div class="col-md-8">
		<div class="checkbox">
			<input name="cnf_multilang" type="checkbox" id="cnf_multilang" value="1"
			@if(CNF_MULTILANG ==1) checked @endif
			  />  {{ Lang::get('core.fr_enable') }}  <span class="label label-info"> Experimental</span> 
		</div>	
	 </div> 
  </div> 
     
   <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_mainlanguage'); }} </label>
	<div class="col-md-8">
			<select class="form-control" name="cnf_lang">
			@foreach(SiteHelpers::langOption() as $lang)
				<option value="{{  $lang['folder'] }}"
				@if(CNF_LANG ==$lang['folder']) selected @endif
				>{{  $lang['name'] }}</option>
			@endforeach
		</select>
	 </div> 
  </div>   
      
   <div class="form-group">
    <label for="ipt" class=" control-label col-md-4"> Frontend Template </label>
	<div class="col-md-8">
			<select class="form-control" name="cnf_theme">
			@foreach(SiteHelpers::themeOption() as $t)
				<option value="{{  $t['folder'] }}"
				@if(CNF_THEME ==$t['folder']) selected @endif
				>{{  $t['name'] }}</option>
			@endforeach
		</select>
	 </div> 
  </div> -->
  
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
	<div class="col-md-8">
		<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges'); }} </button>
	 </div> 
  </div> 
</div>

<div class="col-sm-6">

  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4">Metakey </label>
	<div class="col-md-8">
		<textarea class="form-control input-sm" name="cnf_metakey">{{ CNF_METAKEY }}</textarea>
	 </div> 
  </div> 

   <div class="form-group">
    <label  class=" control-label col-md-4">Meta Descriptiom</label>
	<div class="col-md-8">
		<textarea class="form-control input-sm"  name="cnf_metadesc">{{ CNF_METADESC }}</textarea>
	 </div> 
  </div>  
  <div class="form-group">
    <label  class=" control-label col-md-4">Content footer</label>
	<div class="col-md-8">
		<textarea class="form-control input-sm mceEditor" row='10' clos="10"  name="cnf_footer">{{ CNF_FOOTER }}</textarea>
	 </div> 
  </div>

</div>  
 {{ Form::close() }}

</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() { 

		$(function(){
		tinymce.init({	
			mode : "specific_textareas",
			editor_selector : "mceEditor",
			 plugins : "openmanager",
			 file_browser_callback: "openmanager",
			 theme_advanced_buttons3 : "forecolor , backcolor ,forecolorpicker, backcolorpicker , fontselect, fontsizeselect ",
			 open_manager_upload_path: '../../../../../../../../uploads/images/',
		 });
	});

	});
</script>




