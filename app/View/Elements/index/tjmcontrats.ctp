<nav class="navbar toolbar ">
<?php 
$passaction = $this->params->action;
if (count($this->params->data) > 0) :
    $keyword = $this->params->data['Tjmcontrat']['SEARCH'];
elseif (isset($this->params->pass[0]) && $this->params->pass[0] !=''):
    $keyword = $this->params->pass[0];
elseif (isset($keywords) && $keywords != ''):
    $keyword = $keywords;
else :
    $keyword = '';
endif;    
?>       
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Tjmcontrat",array('url' => array('action' => 'search'), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?> 
                    </li>
                </ul>
            </li>
        </ul> 
</nav>
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
<thead>
<tr>
                <th><?php echo $this->Paginator->sort('TJM','TJM contrat'); ?></th>
                <th width="40px;" ><?php echo $this->Paginator->sort('ANNEE','Année'); ?></th>
                <th width="60px;"  class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($tjmcontrats)): ?>
<?php foreach ($tjmcontrats as $tjmcontrat): ?>
<tr>
        <td><?php echo h($tjmcontrat['Tjmcontrat']['TJM']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($tjmcontrat['Tjmcontrat']['ANNEE']); ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>TJM COntrat :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($tjmcontrat['Tjmcontrat']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($tjmcontrat['Tjmcontrat']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $tjmcontrat['Tjmcontrat']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $tjmcontrat['Tjmcontrat']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce TJM contrat ?')); ?>                    
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
    $(document).on('keyup','#TjmcontratSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>tjmcontrats/search/";
        $(this).parents('form').attr('action',url+$(this).val());
    });        
});
</script>