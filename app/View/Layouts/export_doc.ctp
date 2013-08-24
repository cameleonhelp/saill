<?php
date_default_timezone_set("Europe/Paris");
$key = new DateTime();
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-word; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"Rapport_".$this->params['controller'].'_'.$key->format("Y_m_d_H_i_s").".doc" );
header ("Content-Description: Generated Report" );
echo "\xEF\xBB\xBF"; // UTF-8 BOM
?>
<?php echo $content_for_layout ?> 
