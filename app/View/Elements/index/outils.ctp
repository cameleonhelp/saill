<nav class="navbar toolbar ">
    <?php 
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Outil']['SEARCH'];
        elseif (isset($this->params->pass[0]) && $this->params->pass[0] !=''):
            $keyword = $this->params->pass[0];
        elseif (isset($keywords) && $keywords != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
    ?>
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>   
        <li class="divider-vertical-only"></li>
        <?php endif; ?>   
        <li><?php echo $this->Html->link('<span class="glyphicons eye_close size14 margintop4 notactive" rel="tooltip" data-title="Ouvrir ou fermer le détail des utilisateurs de cette page"></span>', "#",array('class'=>"md btn_eye_close",'escape' => false)); ?></li>    
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Outil",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
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
                <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                <th><?php echo $this->Paginator->sort('Utilisateur.NOMLONG','Gestionnaire '); ?></th>
                <th width="80px;" style="text-align:center;"><?php echo $this->Paginator->sort('VALIDATION','A faire valider'); ?></th>
                <th class="actions" width="60px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($outils)): ?>
<?php foreach ($outils as $outil): ?>
<tr>
        <td><?php echo h($outil['Outil']['NOM']); ?>&nbsp;</td>
        <td><?php echo h($outil['Utilisateur']['NOMLONG']); ?>&nbsp;</td>
        <td style="text-align:center;"><?php echo h($outil['Outil']['VALIDATION']) == 1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $outil['Outil']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $outil['Outil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cet outil ?')); ?>
            <?php endif; ?>
        </td>
</tr>      
<tr class="trhidden" style="display:none;">
    <td colspan="5" align="center">
        <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
            <tr><th>Commentaire</th></tr>
            <tr><td><?php echo $outil['Outil']['DESCRIPTION']; ?></td></tr>
        </table>
    </td>
</tr>               
<?php endforeach; ?>
<?php endif; ?>
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
        $(document).on('click','.eye_open',function(e){
            $(this).parents('tr').next('.trhidden').slideToggle("slow");
        });    
    });
    
    $(document).on('click','.btn_eye_close',function(e){
        var overlay = $('#overlay');
        overlay.show();         
        $('.trhidden').slideToggle("slow");
        $(this).toggleClass('filtreactif');     
        $('.eye_close').toggleClass('margintop4');    
        overlay.hide(); 
    });  
    
    $(document).on('keyup','#OutilSEARCH',function (event){
        var url = "<?php echo $this->webroot;?>outils/search/";
        $(this).parents('form').attr('action',url+$(this).val());
    }); 
</script> 