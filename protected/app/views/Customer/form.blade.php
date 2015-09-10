
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('Customer?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'Customer/save/'.SiteHelpers::encryptID($row['customer_id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> {{ Lang::get('core.customer') }}</legend>
									

									  {{ Form::hidden('customer_id', $row['customer_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 

								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.customer_name') }} </label>
									<div class="col-md-6">
									  {{ Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'', 'readonly'=>''  )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }} </label>
									<div class="col-md-6">
									  {{ Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'',  'readonly'=>'' )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Phone" class=" control-label col-md-4 text-left"> {{ Lang::get('core.phone') }} </label>
									<div class="col-md-6">
									  {{ Form::text('phone', $row['phone'],array('class'=>'form-control', 'placeholder'=>'', 'readonly'=>''  )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Phone" class=" control-label col-md-4 text-left"> Tổng tiền </label>
									<div class="col-md-6">
									  {{ Form::text('money', $row['money'],array('class'=>'form-control', 'placeholder'=>'', 'readonly'=>''  )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Phone" class=" control-label col-md-4 text-left"> Cộng vào </label>
									<div class="col-md-6">
									  {{ Form::text('money_more', '0',array('class'=>'form-control', 'placeholder'=>''  )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Phone" class=" control-label col-md-4 text-left"> Trừ bớt </label>
									<div class="col-md-6">
									  {{ Form::text('money_loss', '0',array('class'=>'form-control', 'placeholder'=>''  )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <!--<div class="form-group  " >
									<label for="Password" class=" control-label col-md-4 text-left"> {{ Lang::get('core.password') }} </label>
									<div class="col-md-6">
									  {{ Form::text('password', $row['password'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Username" class=" control-label col-md-4 text-left"> {{ Lang::get('core.username') }} </label>
									<div class="col-md-6">
									  {{ Form::text('username', $row['username'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Address" class=" control-label col-md-4 text-left"> {{ Lang::get('core.address') }} </label>
									<div class="col-md-6">
									  {{ Form::text('address', $row['address'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="OrderDate" class=" control-label col-md-4 text-left"> {{ Lang::get('core.table_city') }} </label>
									<div class="col-md-6">
									  
				<select name='provinceid' rows='5' id='city' code='{$provinceid}' 
							class='select2 '    ></select>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="RequiredDate" class=" control-label col-md-4 text-left"> {{ Lang::get('core.table_district') }} </label>
									<div class="col-md-6">
									  
				<select name='districtid' rows='5' id='district' code='{$districtid}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ShippedDate" class=" control-label col-md-4 text-left"> {{ Lang::get('core.table_ward') }} </label>
									<div class="col-md-6">
									  
				<select name='wardid' rows='5' id='ward' code='{$wardid}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>-->
								  
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.customer_status') }} </label>
									<div class="col-md-6">
									   <label class='checked'>
										<input type='radio' name='status' value ='0' required @if($row['status'] == '0' || $row['status'] == '') checked="checked" @endif > {{ Lang::get('core.disable') }} </label>
										<label class='checked'>
										<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.enable') }} </label> 
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
				<button type="button" onclick="location.href='{{ URL::to('Customer?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
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