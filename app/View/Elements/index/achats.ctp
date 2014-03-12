<nav class="navbar toolbar ">
        <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'toutes';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Achat']['SEARCH'];
        elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
            $keyword = $this->params->pass[1];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'toutes'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Activités <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => $passaction,'toutes',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'toutes'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($activites as $activite): ?>
                    <li><?php echo $this->Html->link($activite['Activite']['NOM']." - ".$activite['Projet']['NOM'], array('action' => $passaction,$activite['Activite']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$activite['Activite']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                   
        <li class="divider-vertical-only"></li>                
        <li><?php echo $this->Html->link('<span class="ico-xls"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
        </ul> 
        <?php echo $this->Form->create("Achat",array('url' => array('action' => 'search',$pass0), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
        <?php echo $this->Form->end(); ?> 
</nav>
</div>
<div class="panel-body panel-filter marginbottom15 ">
                <strong>Filtre appliqué : </strong><em>Liste de tous les achats sur <?php echo $factivite; ?></em></div>
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('activite_id','Activité'); ?></th>
                <th><?php echo $this->Paginator->sort('LIBELLEACHAT','Achat'); ?></th>
                <th width="90px;"><?php echo $this->Paginator->sort('DATE','Date d\'achat'); ?></th>
                <th><?php echo $this->Paginator->sort('MONTANT','Montant en €'); ?></th>
                <th width="60px;" class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($achats)): ?>            
<?php foreach ($achats as $achat): ?>
<tr>
        <td><?php echo h($achat['Activite']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($achat['Achat']['LIBELLEACHAT']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($achat['Achat']['DATE']); ?>&nbsp;</td>
        <td style="text-align: right;"><?php echo h(isset($achat['Achat']['MONTANT']) ? $achat['Achat']['MONTANT'] :'0'); ?> €&nbsp;</td>
        <td class="actions">
            <div>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'view')) : ?>
                <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'edit')) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $achat['Achat']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'delete')) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $achat['Achat']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet achat ?')); ?>                    
                <?php endif; ?>
            </div>
        </td>
</tr>		
<tr class="trhidden" style="display:none;">
    <td colspan="5" align="center">
        <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
            <tr><th>Commentaire</th></tr>
            <tr><td><?php echo $achat['Achat']['DESCRIPTION']; ?></td></tr>
        </table>
    </td>
</tr>           
<?php endforeach; ?>
<?php endif; ?>
</tbody>
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
        $(document).on('click','.eye_open',function(e){
            $(this).parents('tr').next('.trhidden').slideToggle("slow");
        });   
        
        $(document).on('keyup','#AchatSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>achats/search/<?php echo $pass0;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 