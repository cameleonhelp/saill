<div class="mws index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('mws', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php //filtres par défaut
                $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '1';
                $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : null;
                ?>     
                <!-- filtres -->
                <li class="divider-vertical-only"></li>
                <li class="dropdown <?php echo filtre_is_actif($pass0,'1'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre actif<b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Actifs', array('action' => 'index',1,$pass1),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'1'))); ?></li>
                     <li><?php echo $this->Html->link('Inactifs', array('action' => 'index',0,$pass1),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'0'))); ?></li>
                     </ul>
                </li>    
                <!-- filtres -->
                <li class="divider-vertical-only"></li>
                <li class="dropdown <?php echo filtre_is_actif($pass1,''); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre outil <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,null),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,''))); ?></li>
                     <li class="divider"></li>
                     <?php foreach ($envoutils as $obj): ?>
                     <li><?php echo $this->Html->link($obj['Envoutil']['NOM'], array('action' => 'index',$pass0,$obj['Envoutil']['id']),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,$obj['Envoutil']['id']))); ?></li>
                     <?php endforeach; ?>
                     </ul>
                </li>                
                </ul> 
                <?php echo $this->Form->create("Mw",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste des middlewares <?php echo $strfilter; ?></em></div><?php } ?>      
        <div class="marginright10">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('Envoutil.NOM','Logiciels'); ?></th>
                <th><?php echo $this->Paginator->sort('PVU'); ?></th>
                <th><?php echo $this->Paginator->sort('COUTUNITAIRE','Coût unitaire'); ?></th>
                <th width="30px"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th> 
                <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mws as $mw): ?>
	<tr>
            <td><?php echo h($mw['Mw']['NOM']); ?>&nbsp;</td> 
            <td><?php echo h($mw['Envoutil']['NOM']); ?>&nbsp;</td>  
                <td style="text-align:right;"><?php echo h($mw['Mw']['PVU']); ?>&nbsp;</td>            
		<td style="text-align:right;"><?php echo h($mw['Mw']['COUTUNITAIRE']); ?>&nbsp;</td>
                <td style="text-align:center;"><?php $image = (isset($mw['Mw']['ACTIF']) && $mw['Mw']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="actif cursor showoverlay" data-id="<?php echo $mw['Mw']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>                 
		<td class="actions">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('mws', 'view')) : ?>
                <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>MW :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($mw['Mw']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($mw['Mw']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('mws', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $mw['Mw']['id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('mws', 'delete')) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons bin showoverlay notchange"></span>', array('action' => 'delete', $mw['Mw']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce "MW" ?')); ?>                    
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
                url: "<?php echo $this->Html->url(array('controller'=>'mws','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
});
</script>