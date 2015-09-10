
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('post?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'post/save/'.SiteHelpers::encryptID($row['post_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Sản phẩm - {{$row['post_name']}}</legend>
									  {{ Form::hidden('post_id', $row['post_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
								  <div class="form-group  " >
									<label for="Post Subject" class=" control-label col-md-4 text-left"> Tên sản phẩm </label>
									<div class="col-md-6">
										<input type="text" readonly value="{{$row['post_name']}}" class="form-control" />
									 </div> 
									 <div class="col-md-2">

									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Post Provincefrom" class=" control-label col-md-4 text-left"> Mã sản phẩm </label>
									<div class="col-md-6">
										<input type="text" readonly value="{{$row['post_code']}}" class="form-control" />
									 </div> 
									 <div class="col-md-2">
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Districtfrom" class=" control-label col-md-4 text-left"> Danh mục </label>
									<div class="col-md-6">
									  
										<input type="text" readonly value="{{SiteHelpers::getNameCat($row['post_category'])}}" class="form-control" />
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Addressfrom" class=" control-label col-md-4 text-left">Giá </label>
									<div class="col-md-6">
									  <input type="text" readonly value="{{number_format($row['post_price'],0,',','.') }} VNĐ" class="form-control" />
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Provinceto" class=" control-label col-md-4 text-left"> Giá khuyến mãi </label>
									<div class="col-md-6">
										<input type="text" readonly value="{{number_format($row['post_price_promotion'],0,',','.') }} VNĐ" class="form-control" />
									 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post Districtto" class=" control-label col-md-4 text-left"> Số điện thoại </label>
									<div class="col-md-6">
										<input type="text" readonly value="{{$row['phone'] }}" class="form-control" />
			
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  
								 
								  <!--<div class="form-group  " >
									<label for="Post File1" class=" control-label col-md-4 text-left"> Post File1 </label>
									<div class="col-md-6">
									  {{ Form::text('post_file1', $row['post_file1'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Post File2" class=" control-label col-md-4 text-left"> Post File2 </label>
									<div class="col-md-6">
									  {{ Form::text('post_file2', $row['post_file2'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					-->
								  @if($row['active'] == 0)
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Kích hoạt </label>
									<div class="col-md-6">
									  <label class='checked'>
										<input type='radio' name='active' value ='0' required @if($row['active'] == '0' || $row['active'] == '') checked="checked" @endif > UnActive </label>
										<label class='checked'>
										<input type='radio' name='active' value ='1' required @if($row['active'] == '1') checked="checked" @endif > Active </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  @elseif
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
								  @endif
								   </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<input type="submit" name="apply" class="btn btn-info" value="{{ Lang::get('core.sb_apply') }} " />
				<input type="submit" name="submit" class="btn btn-primary" value="{{ Lang::get('core.sb_save') }}  " />
				<button type="button" onclick="location.href='{{ URL::to('post?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
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