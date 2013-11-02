<div class="puissances index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('puissances', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php //filtres par défaut
                $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '1';
                $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'all';
                $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : '0';
                $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : '0';
                ?>     
                <!-- filtres -->
                <li class="divider-vertical-only"></li>
                <li class="dropdown <?php echo filtre_is_actif($pass0,'1'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre actif <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Actifs', array('action' => 'index',1,$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'1'))); ?></li>
                     <li><?php echo $this->Html->link('Inactifs', array('action' => 'index',0,$pass1,$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'0'))); ?></li>
                     </ul>
                </li>   
                <li class="dropdown <?php echo filtre_is_actif($pass1,'all'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre application <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index',$pass0,'all',$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'all'))); ?></li>
                     <li class="divider"></li>
                     <?php foreach ($applications as $obj): ?>
                     <li><?php echo $this->Html->link($obj['Application']['NOM'], array('action' => 'index',$pass0,$obj['Application']['id'],$pass2,$pass3),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,$obj['Application']['id']))); ?></li>
                     <?php endforeach; ?>
                     </ul>
                </li> 
                <li class="dropdown <?php echo filtre_is_actif(array($pass2,$pass3),array('0','0')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre ... <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <?php
                       $inverse_db = $pass2 == 0 ? 1 : 0;
                       $img_db = $pass2 == 1 ?  "unchecked bottom2" : "check bottom2";
                       $inverse_app = $pass3 == 0 ? 1 : 0;
                       $img_app = $pass3 == 1 ?  "unchecked bottom2" : "check bottom2";                      
                     ?>                           
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_db.'"></span> Database', array('action' => 'index',$pass0,$pass1,$inverse_db,$pass3),array('escape' => false,'class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_app.'"></span> Application', array('action' => 'index',$pass0,$pass1,$pass2,$inverse_app),array('escape' => false,'class'=>'showoverlay')); ?></li>                     
                     </ul>
                </li>                 
                </ul> 
                <?php echo $this->Form->create("Puissance",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20">
            <strong>Filtre appliqué : </strong><em>Liste des puissances <?php echo $strfilter; ?></em></div><?php } ?>    
        <div class="marginright10">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
            <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
            <th><?php echo $this->Paginator->sort('Application.NOM','Nom de l\'application'); ?></th>
            <th><?php echo $this->Paginator->sort('PUISSANCE','Puissance'); ?></th>
            <th width="30px"><?php echo $this->Paginator->sort('DATABASE','Database'); ?></th>
            <th width="30px"><?php echo $this->Paginator->sort('APPLICATION','Application'); ?></th>
            <th width="30px"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($puissances as $puissance): ?>
	<tr>
            <td><?php echo h($puissance['Puissance']['NOM']); ?>&nbsp;</td>
            <td><?php echo $puissance['Application']['id']==0 ? "Toutes les applications" : h($puissance['Application']['NOM']); ?>&nbsp;</td>
            <td style="text-align:right;"><?php echo h($puissance['Puissance']['PUISSANCE']); ?>&nbsp;</td>
            <td style="text-align:center;"><?php $image = (isset($puissance['Puissance']['DATABASE']) && $puissance['Puissance']['DATABASE']==true) ? 'ok_2' : '' ; ?>
            <span class="glyphicons <?php echo $image; ?> notchange"></span></td>
            <td style="text-align:center;"><?php $image = (isset($puissance['Puissance']['APPLICATION']) && $puissance['Puissance']['APPLICATION']==true) ? 'ok_2' : '' ; ?>
            <span class="glyphicons <?php echo $image; ?> notchange"></span></td>
            <td style="text-align:center;"><?php $image = (isset($puissance['Puissance']['ACTIF']) && $puissance['Puissance']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                <a href="#" class="actif cursor showoverlay" data-id="<?php echo $puissance['Puissance']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>              
            <td class="actions">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('puissances', 'view')) : ?>
                <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Puissance :</h3>" data-content="<contenttitle>Commentaire: </contenttitle>'.h($puissance['Puissance']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($puissance['Puissance']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($puissance['Puissance']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('puissances', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit',$puissance['Puissance']['id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('puissances', 'delete')) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons bin showoverlay notchange"></span>', array('action' => 'delete',$puissance['Puissance']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette puissance ?')); ?>                    
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
                url: "<?php echo $this->Html->url(array('controller'=>'puissances','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
});
</script>