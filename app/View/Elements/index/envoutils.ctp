<nav class="navbar toolbar ">
<?php 
$pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '1';
$pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : '3';
$pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Envoutil']['SEARCH'];
elseif (isset($this->params->pass[3]) && $this->params->pass[3] !=''):
    $keyword = $this->params->pass[3];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;    
?>       
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('envoutils', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>  
        <!-- filtres -->
        <li class="divider-vertical-only"></li>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'1'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre actif <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Actifs', array('action' => 'index',1,$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'1'))); ?></li>
             <li><?php echo $this->Html->link('Inactifs', array('action' => 'index',0,$pass1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'0'))); ?></li>
             </ul>
        </li>    
        <!-- filtres -->
        <li class="divider-vertical-only"></li>
        <li class="dropdown <?php echo filtre_is_actif($pass1,'3'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre OS <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => 'index',$pass0,3,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'3'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('OS', array('action' => 'index',$pass0,1,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'1'))); ?></li>
             <li><?php echo $this->Html->link('Logiciels', array('action' => 'index',$pass0,0,$pass2,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'0'))); ?></li>
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
                        <?php echo $this->Form->create("Envoutil",array('url' => array('action' => 'search',$pass0,$pass1,$pass2), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des outils <?php echo $strfilter; ?></em></div><?php } ?>    
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
    <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
    <th><?php echo $this->Paginator->sort('Entite.NOM','Cercle'); ?></th>
    <th width="40px"><?php echo $this->Paginator->sort('OS','OS'); ?></th>
    <th width="30px"><?php echo $this->Paginator->sort('ACTIF','Actif'); ?></th>
    <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<?php foreach ($envoutils as $envoutil): ?>
<tr>
    <td><?php echo h($envoutil['Envoutil']['NOM']); ?>&nbsp;</td>
    <td><?php echo h($envoutil['Entite']['NOM']); ?>&nbsp;</td>
    <?php $image_os = (isset($envoutil['Envoutil']['OS']) && $envoutil['Envoutil']['OS']==true) ? 'ok_2' : '' ; ?>
    <td style="text-align:center;"><span class="glyphicons <?php echo $image_os; ?> notchange"></span></td>
    <td style="text-align:center;"><?php $image = (isset($envoutil['Envoutil']['ACTIF']) && $envoutil['Envoutil']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
        <a href="#" class="actif cursor showoverlay" data-id="<?php echo $envoutil['Envoutil']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a></td>  
    <td class="actions">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('envoutils', 'view')) : ?>
        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Outils :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($envoutil['Envoutil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($envoutil['Envoutil']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('envoutils', 'edit')) : ?>
        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $envoutil['Envoutil']['id']),array('escape' => false)); ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('envoutils', 'delete')) : ?>
        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $envoutil['Envoutil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet outil ?')); ?>                    
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
                url: "<?php echo $this->Html->url(array('controller'=>'envoutils','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    
    $(document).on('keyup','#EnvoutilSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>envoutils/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/<?php echo $pass2; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });        
});
</script>