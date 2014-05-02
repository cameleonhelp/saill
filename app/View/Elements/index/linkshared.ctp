        <nav class="navbar toolbar">
        <?php 
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Linkshared']['SEARCH'];
        elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
            $keyword = $this->params->pass[1];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" data-container="body" rel="tooltip" data-title="Ajoutez un lien"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <?php endif; ?>
                </ul> 
                <ul class="nav navbar-nav toolbar pull-right">
                   <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'data-toggle'=>"modal",'data-target'=>"#modalhelp")); ?></li>
                   <li class="dropdown">
                       <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                       <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                           <li>
                               <?php echo $this->Form->create("Linkshared",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                                   <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                                   <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                               <?php echo $this->Form->end(); ?>                         
                           </li>
                       </ul>
                   </li>
               </ul>                               
        </nav>
        <?php echo $this->element('modals/help',array('helpcontent' => $this->element('hlp/hlp-linkshared'))); ?>
        <div class="">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
            <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
            <th><?php echo $this->Paginator->sort('LINK','Url'); ?></th>
            <th width="40px"><?php echo $this->Paginator->sort('LINK','Lien'); ?></th>
            <th width="60px" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php if (isset($linkshareds)): ?>
	<?php foreach ($linkshareds as $linkshared): ?>
	<tr>
            <td><?php echo h($linkshared['Linkshared']['NOM']); ?>&nbsp;</td>
            <td><?php echo h($linkshared['Linkshared']['LINK']); ?>&nbsp;</td>
            <td style="text-align: center;"><?php echo $this->Html->link('<span class="glyphicons globe_af default notchange" rel="tooltip" data-title="Cliquez pour ouvrir dans un nouvel onglet"></span>',$linkshared['Linkshared']['LINK'],array('escape' => false,'target'=>'_blank')); ?>&nbsp;</td>
            <td class="actions">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'view')) : ?>
                <?php echo '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Lien :</h3>" data-content="<contenttitle>Crée par: </contenttitle>'.h($linkshared['Utilisateur']['NOMLONG']).'<br/><contenttitle>Crée le: </contenttitle>'.h($linkshared['Linkshared']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($linkshared['Linkshared']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>&nbsp;
                <?php endif; ?>
                <?php if ((userAuth('profil_id')!='2' && isAuthorized('linkshareds', 'edit') && userAuth('id')==$linkshared['Linkshared']['utilisateur_id']) || in_array(userAuth('profil_id'),array(-2,1,17))) : ?>
                <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $linkshared['Linkshared']['id']),array('escape' => false)); ?>&nbsp;
                <?php endif; ?>
                <?php if ((isAuthorized('linkshareds', 'delete') && userAuth('id')==$linkshared['Linkshared']['utilisateur_id']) || in_array(userAuth('profil_id'),array(-2,1,17))) : ?>
                <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $linkshared['Linkshared']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce lien ?')); ?>
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
        
        $(document).on('keyup','#LinksharedSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>linkshareds/search/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 