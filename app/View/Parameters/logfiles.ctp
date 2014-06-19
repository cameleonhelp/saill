<div>   
<?php 
if(isset($logs) && count($logs)> 0):
    foreach($logs as $log):
        print_r('<div class="well well-white" style="height:250px;margin-top:15px;margin-bottom:-15px;overflow-y:auto"><h3>'.$log['name'].'</h3></br>'.file_get_rcontent($log['url'],true).'</div><br>');
        echo $this->Html->link('Suppresion du fichier '.$log['name'],array('action'=>'delfile',  str_replace('/', '-', $log['url'])),array('class'=>'btn btn-sm pull-left btn-default'),'Voulez-vous vraiment supprimer le fichier '.$log['name'].' ?');
        echo '<br><br>';
    endforeach;
 else:
     print_r('<div class="well well-white" style="height:250px;margin-top:15px;margin-bottom:-15px;overflow-y:auto">Aucun journal d\'erreur, tout va donc très bien ;-)</div><br>');
 endif;
?>
<div style="margin-left:-10px;margin-right:-15px;">
<div class="form-group">
  <div class="btn-block-horizontal">
      <div class="block-horizontal"> 
        <?php echo $this->Html->link('Vider le dossier des logs',array('action'=>'cleanlogfolder'),array('class'=>'btn btn-sm pull-left btn-danger'),'Voulez-vous vraiment vider le dossier des logs ?'); ?>
      </div>
  </div>
  <div class="marginbottom15"></div>
</div>  
</div>
</div>    