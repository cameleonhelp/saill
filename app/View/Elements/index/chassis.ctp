<nav class="navbar toolbar ">
<?php 
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '1';
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
$pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Chassis']['SEARCH'];
elseif (isset($this->params->pass[3]) && $this->params->pass[3] !=''):
    $keyword = $this->params->pass[3];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;    
?>       
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('chassis', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 1;
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : null;
        ?>     
        <!-- filtres -->
        <li class="divider-vertical-only"></li>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'1'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre actif<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Actifs', array('action' => $passaction,1,$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'1'))); ?></li>
             <li><?php echo $this->Html->link('Inactifs', array('action' => $passaction,0,$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'0'))); ?></li>
             </ul>
        </li>    
        <!-- filtres -->
        <li class="divider-vertical-only"></li>
        <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre localité <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous',$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'tous'))); ?></li>
             <li class="divider"></li>
             <?php foreach ($localites as $localite): ?>
             <li><?php echo $this->Html->link($localite['Localite']['NOM'], array('action' => $passaction,$pass0,$localite['Localite']['id'],$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,$localite['Localite']['id']))); ?></li>
             <?php endforeach; ?>
             </ul>
        </li>                 
        <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre cercle<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
             <li class="divider"></li>
             <?php foreach ($cercles as $cercle): ?>
                <li><?php echo $this->Html->link($cercle['Entite']['NOM'], array('action' => $passaction,$pass0,$pass1,$cercle['Entite']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,$cercle['Entite']['id']))); ?></li>
             <?php endforeach; ?>
             </ul>
        </li>            
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Chassis",array('url' => array('action' => 'search',$pass0,$pass1,$pass2), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des chassis <?php echo $strfilter; ?></em></div><?php } ?>     
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
    <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
    <th><?php echo $this->Paginator->sort('Entite.NOM','Cercle'); ?></th>
    <th><?php echo $this->Paginator->sort('Locatite.NOM','Hébergé à'); ?></th>
    <th><?php echo $this->Paginator->sort('NIVEAU','Niveau'); ?></th>
    <th><?php echo $this->Paginator->sort('ARMOIRE','Armoire'); ?></th>
    <th><?php echo $this->Paginator->sort('PVU','PVU'); ?></th>
    <th width="30px"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th>            
    <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<?php foreach ($chassis as $chassis): ?>
<tr>
    <td><?php echo h($chassis['Chassis']['NOM']); ?>&nbsp;</td>
    <td><?php echo h($chassis['Entite']['NOM']); ?>&nbsp;</td>
    <td><?php echo h($chassis['Localite']['NOM']); ?></td>
    <td><?php echo h($chassis['Chassis']['NIVEAU']); ?>&nbsp;</td>
    <td><?php echo h($chassis['Chassis']['ARMOIRE']); ?>&nbsp;</td>
    <td style="text-align:right;"><?php echo h($chassis['Chassis']['PVU']); ?>&nbsp;</td>
    <td style="text-align:center;"><?php $image = (isset($chassis['Chassis']['ACTIF']) && $chassis['Chassis']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
        <a href="#" class="actif cursor showoverlay" data-id="<?php echo $chassis['Chassis']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>             
    <td class="actions">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('chassis', 'view')) : ?>
        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Chassis :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($chassis['Chassis']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($chassis['Chassis']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('chassis', 'edit')) : ?>
        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $chassis['Chassis']['id']),array('escape' => false)); ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('chassis', 'delete')) : ?>
        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $chassis['Chassis']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce chassis ?')); ?>                    
        <?php endif; ?>                    
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>
<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
<div class="pull-right "><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>   
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
<script>
$(document).ready(function () {
    $(document).on('click','.actif',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'chassis','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    
    $(document).on('keyup','#ChassisSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>chassis/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/<?php echo $pass2; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });           
});
</script>