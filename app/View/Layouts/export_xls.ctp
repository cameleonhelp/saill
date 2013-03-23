<?php
header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"".$this->params['controller'].'_'.date('Y_m_d').".xls" );
header ("Content-Description: Generated Report" );
?>
<?php echo $content_for_layout ?> 
