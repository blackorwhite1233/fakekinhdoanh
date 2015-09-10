<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
{{ HTML::script('sximo/js/preview-image/modernizr.custom.js')}}
{{ HTML::script('sximo/js/preview-image/script.js')}}
<script id="imageTemplate" type="text/x-jquery-tmpl"> 
    <div class="imageholder">
		<figure>
			<img src="${filePath}" alt="${fileName}" width="455px" height="101px"/>
			<figcaption>
			</figcaption>
		</figure>
	</div>
</script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('advertise?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">
	<div class="panel-default panel">
		<div class="panel-body">
		@if(Session::has('message'))	  
			   {{ Session::get('message') }}
		@endif	
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {{ Form::open(array('url'=>'advertise/save/'.SiteHelpers::encryptID($row['advertise_id']).'?md=', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Advertise</legend>
									
								  
									  {{ Form::hidden('advertise_id', $row['advertise_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 					
								  <div class="form-group  " >
									<label for="Advertise Name" class=" control-label col-md-4 text-left"> Tiêu đề </label>
									<div class="col-md-6">
									  {{ Form::text('advertise_name', $row['advertise_name'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertise Link" class=" control-label col-md-4 text-left"> Link </label>
									<div class="col-md-6">
									  {{ Form::text('advertise_link', $row['advertise_link'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Position" class=" control-label col-md-4 text-left"> Vị trí </label>
									<div class="col-md-6">
									  <label class='checked'>
										<input type='radio' name='position' value ='0' required @if($row['position'] == '0' || $row['position'] == '') checked="checked" @endif > Trang chủ </label>
										<label class='checked'>
										<input type='radio' name='position' value ='1' required @if($row['position'] == '1') checked="checked" @endif > Cột phải </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Trạng thái </label>
									<div class="col-md-6">
									 <label class='checked'>
										<input type='radio' name='status' value ='0' required @if($row['status'] == '0' || $row['status'] == '') checked="checked" @endif > Ẩn </label>
										<label class='checked'>
										<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > Hiện </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created" class=" control-label col-md-4 text-left"> Hình ảnh </label>
									<div class="col-md-6">
									  <input id="upload" name="file" type="file" />
									  	<div id="result">
											@if($row['image'] != "")
												<img width="455px" src="/uploads/advertise/thumb/{{$row['image']}}">
											@endif
										</div>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								   </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<input type="submit" name="apply" class="btn btn-info" value="{{ Lang::get('core.sb_apply') }} " />
				<input type="submit" name="submit" class="btn btn-primary" value="{{ Lang::get('core.sb_save') }}  " />
				<button type="button" onclick="location.href='{{ URL::to('advertise?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
	});
	</script>		 