{{ HTML::script('sximo/themes/shop/js/jquery.jcombo.min.js') }}
{{ HTML::style('sximo/themes/uber/css/BeatPicker.min.css')}}
        {{ HTML::script('sximo/themes/uber/js/BeatPicker.min.js') }}
<div class="container">
            <div id="wrap-content">
                <div class="box thread-box guest">
                    <div class="box-heading"><span>Tài xế</span></div>
                    <ul>
                    @foreach($data as $item)
                        {{ SiteHelpers::templatePost($item) }}
                    @endforeach
                    </ul>
                </div><!-- guest-list -->
                <div class="pages">
                    {{ $pagination->appends(array("page"=>$page,"province_from"=>$order['province_from'],"district_from"=>$order['district_from'],"province_to"=>$order['province_to'],"district_to"=>$order['district_to'],"datestar"=>$order['datestar']))->links('pagination_site') }}
                </div><!-- pages -->
            </div><!-- wrap-content -->
            <div id="wrap-right">
                <div class="box filter">
                    <div class="box-heading">Bộ lọc tin</div>
                    <div class="box-content">
                        <form id="formsort" method="get" action="{{URL::to('')}}/tai-xe.html">
                        <div class="input-group place">
                            <label>Nơi xuất phát</label>
                            <select name="province_from" id="province_from" class="form-control">
                            </select>
                            <select name="district_from" id="district_from"  class="form-control">
                            </select>
                        </div>
                        <div class="input-group place">
                            <label>Nơi đến</label>
                            <select name="province_to" id="province_to"  class="form-control">
                            </select>
                            <select name="district_to" id="district_to" class="form-control">
                            </select>
                        </div>
                        <div class="input-group date">
                            <label>Ngày xuất phát</label>
                            <div class="date-row clearfix">
                            <input value="@if($order['datestar'] != ''){{date('d-m-Y',$order['datestar'])}}@endif" type="text" name="datestar" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY'],separator:'-'" data-beatpicker-position="['left','bottom']" data-beatpicker-disable="{from:[1970 , 2 , 2],to:[{{date("Y")}} , {{(int)date("m")}}  , <?php echo (date("d") -1 ) ?> ]}"/>
                            </div><!-- date-row -->
                        </div>
                        <input type="hidden" id="page" name="page" value="{{$page}}" />
                        <button type="submit" class="btn btn-default submit">Lọc tin</button>
                    </form>
                    </div><!-- box-content -->
                </div><!-- filter -->
                 @include('layouts/uber/advertise')<!-- ads -->
            </div><!-- wrap-right -->

        </div><!-- container -->
         <script type="text/javascript">
            $(document).ready(function() { 
                  $("#province_from").jCombo("{{ URL::to('ward/comboselect?filter=province:provinceid:name') }}",
                  {  selected_value : "{{$order['province_from']}}",initial_text: "-- Tỉnh/Thành --", });
                  $("#province_from").on('change', function() {
                    var val = this.value ; 
                    $("#district_from").jCombo("{{ URL::to('ward/comboselect?filter=district:districtid:name:') }}"+val,
                  {  selected_value : "{{$order['district_from']}}",initial_text: "-- Quận/Huyện --", });
                  });
                  $("#province_to").jCombo("{{ URL::to('ward/comboselect?filter=province:provinceid:name') }}",
                  {  selected_value : "{{$order['province_to']}}",initial_text: "-- Tỉnh/Thành --", });
                  $("#province_to").on('change', function() {
                    var val = this.value ; 
                    $("#district_to").jCombo("{{ URL::to('ward/comboselect?filter=district:districtid:name:') }}"+val,
                  {  selected_value : "{{$order['district_to']}}",initial_text: "-- Quận/Huyện --", });
                  });
              });
        </script>


