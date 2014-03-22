<nav class="navbar toolbar ">
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
        <?php endif; ?>
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : '1';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Dsitenv']['SEARCH'];
        elseif (isset($this->params->pass[2]) && $this->params->pass[2] !=''):
            $keyword = $this->params->pass[2];
        elseif (isset($keywords) && $keywords != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;          
        ?>     
        <!-- filtres -->
        <li class="divider-vertical-only"></li>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Applications <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => $passaction,'tous',$pass1,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($applications as $application): ?>
                    <li><?php echo $this->Html->link($application['Application']['NOM'], array('action' => $passaction,$application['Application']['id'],$pass1,$keyword),array('escape' => false,'class'=>'showoverlay'.subfiltre_is_actif($pass0,$application['Application']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                
        <li class="dropdown <?php echo filtre_is_actif($pass1,'1'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Actifs', array('action' => $passaction,$pass0,1,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'1'))); ?></li>
             <li><?php echo $this->Html->link('Inactifs', array('action' => $passaction,$pass0,0,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'0'))); ?></li>
             </ul>
        </li>                
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Dsitenv",array('url' => array('action' => 'search',$pass0,$pass1), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul>           
</nav>
<?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 ">
    <strong>Filtre appliqué : </strong><em>Liste des environnements DSIT pour <?php echo $strfilter; ?></em></div><?php } ?>       
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('NOM'); ?></th>
                <th><?php echo $this->Paginator->sort('Application.NOM','Application'); ?></th>
                <th width="30px"><?php echo $this->Paginator->sort('ACTIF'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($dsitenvs as $dsitenv): ?>
<tr>
        <td><?php echo h($dsitenv['Dsitenv']['NOM']); ?>&nbsp;</td>
        <td><?php echo $dsitenv['Application']['NOM']; ?></td>
        <td style="text-align:center;"><?php $image = (isset($dsitenv['Dsitenv']['ACTIF']) && $dsitenv['Dsitenv']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'edit')) : ?>
            <a href="#" class="actif cursor showoverlay" data-id="<?php echo $dsitenv['Dsitenv']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
        <?php else: ?>
            <span class="glyphicons <?php echo $image; ?> notchange"></span>
        <?php endif; ?>
        </td>                  
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Environnement DSIT :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($dsitenv['Dsitenv']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($dsitenv['Dsitenv']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php echo $this->Html->link('<span class="glyphicons zoom_in showoverlay notchange"></span>', array('action' => 'view', $dsitenv['Dsitenv']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $dsitenv['Dsitenv']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $dsitenv['Dsitenv']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet environnement ?')); ?>
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
<script>
$(document).ready(function () {
    $(document).on('click','.actif',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'dsitenvs','action'=>'ajax_actif')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    
    $(document).on('keyup','#DsitenvSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>dsitenvs/search/<?php echo $pass0; ?>/<?php echo $pass1; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    });       
});
</script>