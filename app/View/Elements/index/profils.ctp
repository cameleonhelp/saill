<nav class="navbar toolbar">
        <?php 
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Profil']['SEARCH'];
        elseif (isset($this->params->pass[0]) && $this->params->pass[0] !=''):
            $keyword = $this->params->pass[0];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>       
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Profil",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
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
                <th><?php echo $this->Paginator->sort('COMMENTAIRE','Description'); ?></th>
                <th class="actions" width="75px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php if (isset($profils)): ?>
<?php foreach ($profils as $profil): ?>
<tr>
        <td><?php echo h($profil['Profil']['NOM']); ?>&nbsp;</td>
        <td><?php echo $profil['Profil']['COMMENTAIRE']; ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'view')) : ?>
            <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Profil :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($profil['Profil']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($profil['Profil']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $profil['Profil']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'delete')) : ?>
            <?php echo $profil['Profil']['id'] > 10 ? $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $profil['Profil']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce profil ?') ): '<span class="glyphicons blank"></span>'; ?>
            <?php else : ?>
            <span class="glyphicons blank"></span>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'duplicate')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons retweet notchange"></span>', array('action' => 'dupliquer', $profil['Profil']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce profil et ses autorisations ?')); ?>
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
        $(document).on('keyup','#ProfilSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>profils/search/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 