<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
</head>
<body>
<?php
date_default_timezone_set("Europe/Paris");
$key = new DateTime();
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . "  Europe/Paris");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-word; charset=UTF-8");
header ("Content-Disposition: attachment; filename=\"Rapport_".$this->params['controller'].'_'.$key->format("Y_m_d_H_i_s").".doc" );
header ("Content-Description: Generated Report" );
//echo "\xEF\xBB\xBF"; // UTF-8 BOM
?>
<?php echo $content_for_layout ?> 
</body>
</html>