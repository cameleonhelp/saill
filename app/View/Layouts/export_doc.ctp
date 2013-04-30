<?php
date_default_timezone_set("Europe/Paris");
$key = new DateTime();
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-word");
header ("Content-Disposition: attachment; filename=\"Rapport_".$this->params['controller'].'_'.$key->format("Y_m_d_H_i_s").".doc" );
header ("Content-Description: Generated Report" );
?>
<?php echo $content_for_layout ?> 
