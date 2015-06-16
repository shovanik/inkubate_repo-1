<ul class="list">
<li><a href="#">Filters by Type</a></li>
<?php if(isset($savedfilters['types'])){
foreach($savedfilters['types'] as $val){ ?>
<li class="li_sml multiple multiple_types_<?php echo $val['type_id'];?>" onclick="saveMultiple(<?php echo $val['type_id'];?>,'multiple','types')" style="cursor:pointer"><?php echo $val['work_type_name'];?></li>
<?php 
}
} ?>
</ul>
<ul class="list">
<li><a href="#">Filters by Format</a></li>
<?php 
if(isset($savedfilters['format'])){
foreach($savedfilters['format'] as $val){ ?>
	<li class="li_sml  multiple multiple_format_<?php echo $val['format_id'];?>" onclick="saveMultiple(<?php echo $val['format_id'];?>,'multiple','format')" style="cursor:pointer"><?php echo $val['work_form_name'];?></li>
<?php 
}
} ?>
</ul>
<ul class="list">
<li><a href="#">Filters by Genre</a></li>
<?php 
if(isset($savedfilters['genre'])){
foreach($savedfilters['genre'] as $val){ ?>
	<li class="li_sml  multiple multiple_genre_<?php echo $val['category_id'];?>" onclick="saveMultiple(<?php echo $val['category_id'];?>,'multiple','genre')" style="cursor:pointer"><?php echo $val['category_name'];?></li>
<?php 
}
} ?>
<li><a href="javascript:;" class="green_bg" name="tab1"  onclick="fnSearchByFilters('multiple')">Click to Search by Filters</a></li>
</ul>
