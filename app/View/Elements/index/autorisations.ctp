<nav class="navbar toolbar ">
        <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'toutes';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Autorisation']['SEARCH'];
        elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
            $keyword = $this->params->pass[1];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>    
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Profils <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($profils as $profil): ?>
                    <li><?php echo $this->Html->link($profil['Profil']['NOM'], array('action' => $passaction,$profil['Profil']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,$profil['Profil']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Autorisation",array('url' => array('action' => 'search',$pass0), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul>                                   
</nav>
<div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste des autorisations pour <?php echo $fprofil; ?></em></div>
<div class=""> 
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('Profil.NOM','Profil'); ?></th>
                <th><?php echo $this->Paginator->sort('MODEL','Modèle'); ?></th>
                <th><?php echo $this->Paginator->sort('INDEX','Lister'); ?></th>
                <th><?php echo $this->Paginator->sort('ADD','Ajouter'); ?></th>
                <th><?php echo $this->Paginator->sort('EDIT','Modifier'); ?></th>
                <th><?php echo $this->Paginator->sort('VIEW','Visualiser'); ?></th>
                <th><?php echo $this->Paginator->sort('DELETE','Supprimer'); ?></th>
                <th><?php echo $this->Paginator->sort('DUPLICATE','Dupliquer'); ?></th>
                <th><?php echo $this->Paginator->sort('INITPASSWORD','Initialiser le mot de passe'); ?></th>
                <th><?php echo $this->Paginator->sort('ABSENCES','Calendrier des absences'); ?></th>
                <th><?php echo $this->Paginator->sort('RAPPORTS','Rapports'); ?></th>
                <th><?php echo $this->Paginator->sort('UPDATE','Mise à jour'); ?></th>
                <th><?php echo $this->Paginator->sort('MYPROFIL','Mon profil'); ?></th>
                <th><?php echo $this->Paginator->sort('MASSE','Saisie en masse'); ?></th>
                <th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($autorisations)): ?>
<?php foreach ($autorisations as $autorisation): ?>
<tr>
        <td><?php echo h($autorisation['Profil']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($autorisation['Autorisation']['MODEL']); ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['INDEX'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['ADD'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['EDIT'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['VIEW'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['DELETE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['DUPLICATE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['INITPASSWORD'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['ABSENCES'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['RAPPORTS'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['UPDATE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['MYPROFIL'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td style='text-align:center;'><?php echo h($autorisation['Autorisation']['MASSE'])==1 ? '<span class="glyphicons ok_2 green"></span>' : ''; ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Autorisation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($autorisation['Autorisation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($autorisation['Autorisation']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if ((userAuth('profil_id')!='1' || userAuth('profil_id')!='2') && h($autorisation['Autorisation']['MODEL'])!='autorisations' && isAuthorized('autorisations', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $autorisation['Autorisation']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'delete')) : ?>
            <?php echo $autorisation['Autorisation']['profil_id']>1 ?  $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $autorisation['Autorisation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette autorisation ?')) : ''; ?>                    
            <?php endif; ?>
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
        $(document).on('keyup','#AutorisationSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>autorisations/search/<?php echo $pass0;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 