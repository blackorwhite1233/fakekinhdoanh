<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
{{ HTML::script('sximo/js/preview-image/modernizr.custom.js')}}
{{ HTML::script('sximo/js/preview-image/script.js')}}
<script id="imageTemplate" type="text/x-jquery-tmpl"> 
    <div class="imageholder">
		<figure>
			<img src="${filePath}" alt="${fileName}"/>
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
		<li><a href="{{ URL::to('Ncategories?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'Ncategories/save/'.SiteHelpers::encryptID($row['CategoryID']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> {{ Lang::get('core.category') }}</legend>
									<input type="hidden" name="action" value="{{$id}}" />
									  {{ Form::hidden('CategoryID', $row['CategoryID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
								  <div class="form-group  " >
									<label for="CategoryName" class=" control-label col-md-4 text-left"> {{ Lang::get('core.category_name') }} </label>
									<div class="col-md-6">
									  {{ Form::text('CategoryName', $row['CategoryName'],array('class'=>'form-control', 'placeholder'=>'Nhập tên danh mục',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CategoryName" class=" control-label col-md-4 text-left"> Vị trí </label>
									<div class="col-md-6">
									  {{ Form::text('postion', $row['postion'],array('class'=>'form-control', 'placeholder'=>'Vị trí từ thấp đến cao',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> {{ Lang::get('core.category_des') }} </label>
									<div class="col-md-6">
									  {{ Form::textarea('Description', $row['Description'],array('class'=>'form-control', 'placeholder'=>'Nội dung mô tả về danh mục.',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <!--<div class="form-group  " >
									<label for="Picture" class=" control-label col-md-4 text-left"> {{ Lang::get('core.category_image') }} </label>
									<div class="col-md-6">
									  <input id="upload" name="file" type="file" />
									  <div id="result">
											@if($row['Picture'] != "")
												<img width="150px" src="/uploads/categories/thumb/{{$row['Picture']}}">
											@endif
										</div>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>-->
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.table_status') }} </label>
									<div class="col-md-6">
									  <label class='checked'>
										<input type='radio' name='status' value ='0' required @if($row['status'] == '0' || $row['status'] == '') checked="checked" @endif > {{ Lang::get('core.disable') }} </label>
										<label class='checked'>
										<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.enable') }} </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="keywords" class=" control-label col-md-4 text-left"> Key Words </label>
									<div class="col-md-6">
									  {{ Form::text('keywords', $row['keywords'],array('class'=>'form-control', 'placeholder'=>'Nội dung từ khóa chính (Thẻ meta Keyword)',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="seo_meta" class=" control-label col-md-4 text-left"> Seo Description </label>
									<div class="col-md-6">
									  {{ Form::textarea('seo_meta', $row['seo_meta'],array('class'=>'form-control', 'placeholder'=>'Nội dung bài viết SEO: Vài dòng mô tả về nội dung trang, gom các từ khóa quan trọng vào, 2 - 3 từ khóa, độ dài khoảng 2 dòng',   )) }} 
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
				<button type="button" onclick="location.href='{{ URL::to('Ncategories?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
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