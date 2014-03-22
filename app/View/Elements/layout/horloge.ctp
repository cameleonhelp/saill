<div style="display:block;">
<div id="flipcountdownboxdate" style="text-align:center;margin-bottom: 10px;"></div>
<?php $today = new DateTime(); ?>
<div id="flipcountdownbox" style="text-align:center;margin-bottom: 10px;"></div>
</div>
<script>
$(document).ready(function () {
    $('#flipcountdownbox').flipcountdown({
	size:"xs"
    });
    $('#flipcountdownboxdate').flipcountdown({
	size:"xs",
        tick: "<?php  echo $today->format('d/m/Y'); ?>"
    });    
});
</script>