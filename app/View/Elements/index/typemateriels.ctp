<nav class="navbar toolbar ">
    <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Typemateriel']['SEARCH'];
        elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
            $keyword = $this->params->pass[1];
        elseif (isset($keywords) && $keywords != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
    ?>        
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre type <b class="caret"></b></a>
             <ul class="dropdown-menu">
                 <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                 <li class="divider"></li>
                 <li><?php echo $this->Html->link('Unité centrale', array('action' => $passaction,'1',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0 ,'1'))); ?></li>
                 <li><?php echo $this->Html->link('Autre', array('action' => $passaction,'0',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0 ,'0'))); ?></li>
             </ul>
        </li>
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Typemateriel",array('url' => array('action' => 'search',$pass0), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul>      
</nav>
<div class="panel-body panel-filter marginbottom15">
            <strong>Filtre appliqué : </strong><em>Liste <?php echo $strfilter; ?></em></div>      
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('DESCRIPTION','Description'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($typemateriels)): ?>
<?php foreach ($typemateriels as $typemateriel): ?>
<tr>
        <td><?php echo h($typemateriel['Typemateriel']['NOM']); ?>&nbsp;</td>
        <td><?php echo $typemateriel['Typemateriel']['DESCRIPTION']; ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Type de matériel :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($typemateriel['Typemateriel']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($typemateriel['Typemateriel']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $typemateriel['Typemateriel']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'delete')) : ?>
            <?php echo $typemateriel['Typemateriel']['UC']== 0 ? $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $typemateriel['Typemateriel']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce type de matériel ?')):''; ?>                    
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
    $(document).on('keyup','#TypematerielSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>typemateriels/search/<?php echo $pass0; ?>/";
        $(this).parents('form').attr('action',url+$(this).val());
    }); 
</script>