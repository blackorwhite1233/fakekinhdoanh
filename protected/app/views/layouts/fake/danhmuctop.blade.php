<?php
    $cats = SiteHelpers::GetCategories();
?>
<ul class="@if($pos == 'top') dropdown-menu @else cat_list @endif">
    @foreach($cats as $cat)
        <li><a href="{{URL::to('danh-muc')}}/{{$cat->alias}}-{{$cat->CategoryID}}.html">{{$cat->CategoryName}}</a></li>
    @endforeach
  </ul>