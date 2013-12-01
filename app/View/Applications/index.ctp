<div class="applications index">
        <nav class="navbar toolbar marginright20">             
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('applications', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php //filtres par défaut
                $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '1';
                ?>     
                <!-- filtres -->
                <li class="divider-vertical-only"></li>
                <li class="dropdown <?php echo filtre_is_actif($pass0,'1'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Actifs', array('action' => 'index',1),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'1'))); ?></li>
                     <li><?php echo $this->Html->link('Inactifs', array('action' => 'index',0),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'0'))); ?></li>
                     </ul>
                </li>
                </ul> 
                <?php echo $this->Form->create("Application",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste des applications <?php echo $strfilter; ?></em></div><?php } ?>     
        <div class="marginright10">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                        <th width="30px"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($applications as $application): ?>
	<tr>
		<td><?php echo h($application['Application']['NOM']); ?>&nbsp;</td>
                <td style="text-align:center;"><?php $image = (isset($application['Application']['ACTIF']) && $application['Application']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                    <a href="#" class="appactif cursor showoverlay" data-id="<?php echo $application['Application']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>               
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('applications', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Application :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($application['Application']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($application['Application']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('applications', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $application['Application']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('applications', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $application['Application']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette application ?')); ?>                    
                    <?php endif; ?>
		</td>                    
	</tr>
<?php endforeach; ?>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>         
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
<script>
$(document).ready(function () {
    $(document).on('click','.actif',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'applications','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
});
</script>