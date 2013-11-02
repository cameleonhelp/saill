<?php
date_default_timezone_set("Europe/Paris");
$key = new DateTime();
//header ("Expires: Mon, 28 Oct 2008 05:00:00 Europe/Paris");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " Europe/Paris");
//header ("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"".$this->params['controller'].'_'.$key->format("Y_m_d_H_i_s").".xls" );
header ("Content-Description: Generated Report" );
echo "\xEF\xBB\xBF"; // UTF-8 BOM
?>
<?php echo $content_for_layout ?> 
