<nav class="navbar toolbar ">
        <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Message']['SEARCH'];
        elseif (isset($this->params->pass[1]) && $this->params->pass[1] !=''):
            $keyword = $this->params->pass[1];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>    
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre cercle<b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
             <li class="divider"></li>
             <?php foreach ($cercles as $cercle): ?>
                <li><?php echo $this->Html->link($cercle['Entite']['NOM'], array('action' => $passaction,$cercle['Entite']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,$cercle['Entite']['id']))); ?></li>
             <?php endforeach; ?>
             </ul>
        </li>           
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Message",array('url' => array('action' => 'search',$pass0), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
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
                <th><?php echo $this->Paginator->sort('LIBELLE','Message'); ?></th>
                <th><?php echo $this->Paginator->sort('Entite.NOM','Cercle'); ?></th>
                <th width="150px;"><?php echo $this->Paginator->sort('DATELIMITE','Date de fin de validité'); ?></th>
                <th class="actions" width="80px;"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>  
<?php if (isset($messages)): ?>
<?php foreach ($messages as $message): ?>
<tr>
        <td><?php echo $message['Message']['LIBELLE']; ?>&nbsp;</td>
        <td><?php echo h($message['Entite']['NOM']); ?>&nbsp;</td>
        <td style="text-align: center;"><?php echo h($message['Message']['DATELIMITE']); ?>&nbsp;</td>
        <td class="actions">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'view')) : ?>
            <?php echo '<span class="clear"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Message :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($message['Message']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($message['Message']['modified']).'" style="cursor: pointer;"></span></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $message['Message']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $message['Message']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce message ?')); ?>
            <?php endif; ?>
        </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
<div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
<div class="pull-right "><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
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
        $(document).on('keyup','#MessageSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>messages/search/<?php echo $pass0; ?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });        
    });
</script> 