<div class="centrecouts index">
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        ?>
        <nav class="navbar toolbar ">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('centrecouts', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre cercles <b class="caret"></b></a>
                     <ul class="dropdown-menu">                         
                         <li><?php echo $this->Html->link('Tous les cercles', array('action' => 'index','tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($departements as $departement): ?>
                            <li><?php echo $this->Html->link($departement['Centrecout']['NOMDEPARTEMENT'], array('action' => 'index',$departement['Centrecout']['id']),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous',$departement['Centrecout']['id']))); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                   
                </ul> 
                <?php echo $this->Form->create("Centrecout",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                <?php echo $this->Form->end(); ?>             
        </nav>
        <div class="">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<thead><tr>
			<th><?php echo $this->Paginator->sort('NOM','Libéllé'); ?></th>
			<th><?php echo $this->Paginator->sort('NOMDEPARTEMENT','Cercle'); ?></th>
			<th><?php echo $this->Paginator->sort('CODEDEPARTEMENT','Département'); ?></th>
			<th><?php echo $this->Paginator->sort('CODEPROJET','Code projet'); ?></th>
			<th><?php echo $this->Paginator->sort('CODEACTIVITE','Code activité'); ?></th>
                        <th width="50px"><?php echo 'Agent SNCF'; ?></th>
                        <th width="50px"><?php echo 'Projets'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr></thead>
        <tbody>
	<?php foreach ($centrecouts as $centrecout): ?>
	<tr>
		<td><?php echo h($centrecout['Centrecout']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($centrecout['Centrecout']['NOMDEPARTEMENT']); ?>&nbsp;</td>
		<td><?php echo h($centrecout['Centrecout']['CODEDEPARTEMENT']); ?>&nbsp;</td>
		<td><?php echo h($centrecout['Centrecout']['CODEPROJET']); ?>&nbsp;</td>
                <td><?php echo h($centrecout['Centrecout']['CODEACTIVITE']); ?>&nbsp;</td>
                <?php $image =  (isset($centrecout['Centrecout']['SNCF']) && $centrecout['Centrecout']['SNCF']==true) ? 'ok_2' : 'ok_2 disabled'; ?>
                <td style="text-align:center;"><span class="glyphicons <?php echo $image; ?> notchange"></span></td>
                <td style="text-align:center;">
                    <a class="btn btn-xs btn-default addprojet" data-cdcid="<?php echo $centrecout['Centrecout']['id']; ?>"><span class="glyphicons notchange list"></span></a>
                </td>
		<td class="actions">
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('centrecouts', 'view')) : ?>
                        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Centre de coût :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($centrecout['Centrecout']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($centrecout['Centrecout']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
			<?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('centrecouts', 'edit')) : ?>
                        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $centrecout['Centrecout']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
			<?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('centrecouts', 'delete')) : ?>
                        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $centrecout['Centrecout']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce centre de coût ?')); ?>
                        <?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
        </div>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right "><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class='text-center'>
        <ul class="pagination pagination-sm">
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
	?>
        </ul>
        </div>
</div>
<?php echo $this->element('modals/projets'); ?>
<script>
$(document).ready(function(){
    $(document).on('click','.addprojet',function(){
        //getJson des projets compris dans ce centre de cout
        var cdc_id = $(this).attr('data-cdcid');
        $('#modalprojets #cdc_id').val(cdc_id);        
        $.ajax({
          dataType: "JSON",
          url: "<?php echo $this->Html->url(array('controller'=>'assocdcprojets','action'=>'json_get_info')); ?>/"+cdc_id,
          data: {},
          success : function(response){
              console.log(response);
              if(response != "null"){
                    var projet_id = response;
                    $('#modalprojets #envsid').val(projet_id);
              }
          },
          error : function (response){
              if(response.responseText != 'null'){
              alert("Erreur! il se peut que votre session soit expirée\n\rOu qu'une erreur inconnue soit intervenue.\n\rActualiser la page et recommencer.");
              }
          }
        }); 
        $.ajax({
          dataType: "JSON",
          url: "<?php echo $this->Html->url(array('controller'=>'assocdcprojets','action'=>'json_get_assoid')); ?>/"+cdc_id,
          data: {},
          success : function(response){
              if(response != "null"){
                    var id = response;
                    $('#modalprojets #assoid').val(id);
              }
          },
          error : function (response){
              if(response.responseText != 'null'){
              alert("Erreur! il se peut que votre session soit expirée\n\rOu qu'une erreur inconnue soit intervenue.\n\rActualiser la page et recommencer.");
              }
          }
        });          
        $('#modalprojets').modal('show');
    });
});
</script>