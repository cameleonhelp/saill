<?php 
    function dateIsEqual($date1,$date2){
        $d1 = explode("/",$date1);
        $n1 = $d1[2].$d1[1].$d1[0];
        $d2 = explode("/",$date2);
        $n2 = $d2[2].$d2[1].$d2[0];
        return $n1==$n2 ? true: false;
    }
?>
<div class="activitesreelles index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Actif', array('action' => 'index','actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Inactif', array('action' => 'index','inactif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                     </ul>
                 </li>                 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Projets <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous')); ?></li>
                     <li><?php echo $this->Html->link('Autres que indisponibilité', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','autres')); ?></li>                     
                     <li class="divider"></li>
                         <?php foreach ($projets as $projet): ?>
                            <li><?php echo $this->Html->link($projet['Projet']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$projet['Projet']['NOM'])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                   
                <li class="divider-vertical"></li>                
                <li><a href="#"><i class="ico-xls"></i></a></li>
                </ul> 
                <?php echo $this->Form->create("Activite",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> sur <?php echo $fprojet; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Agent'; ?></th>
			<th><?php echo 'Date'; ?></th>
                        <th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th width="20px"><?php echo 'Lu.'; ?></th>
			<th width="20px"><?php echo 'Ma.'; ?></th>
			<th width="20px"><?php echo 'Me.'; ?></th>
			<th width="20px"><?php echo 'Je.'; ?></th>
			<th width="20px"><?php echo 'Ve.'; ?></th>
			<th width="20px"><?php echo 'Sa.'; ?></th>
			<th width="20px"><?php echo 'Di.'; ?></th>
			<th><?php echo 'Total'; ?></th>
			<th class="actions" width="90px"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>   
        <?php $r = 0; ?>
        <?php foreach ($groups as $group) : ?>
        <?php $row = $groups[$r][0]['NBACTIVITE']; ?>
        <?php if($row > 1): ?>
            <tr>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['NOM']." ".$group['Utilisateur']['PRENOM']; ?></td>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Activitesreelle']['DATE']; ?></td>
        <?php endif; ?>
        <?php $i = 0; ?>
        <?php foreach ($activitesreelles as $activitesreelle): ?>
            <?php if($activitesreelle['Activitesreelle']['utilisateur_id']==$group['Activitesreelle']['utilisateur_id'] && dateIsEqual($group['Activitesreelle']['DATE'], $activitesreelle['Activitesreelle']['DATE'])): ?>
                <?php if ($row==1): ?>
                <tr>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['NOMLONG']; ?></td>
                <td class="header" style="text-align: center;" ><?php echo $group['Activitesreelle']['DATE']; ?></td>
                <?php endif; ?>
                <td><?php echo $activitesreelle['Activite']['NOM']; ?></td>  
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['LU']!=0 ? $activitesreelle['Activitesreelle']['LU'] : ""; ?></td> 
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['MA']!=0 ? $activitesreelle['Activitesreelle']['MA'] : ""; ?></td> 
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['ME']!=0 ? $activitesreelle['Activitesreelle']['ME'] : ""; ?></td> 
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['JE']!=0 ? $activitesreelle['Activitesreelle']['JE'] : ""; ?></td> 
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['VE']!=0 ? $activitesreelle['Activitesreelle']['VE'] : ""; ?></td> 
                <td style="text-align: center;" class="week"><?php echo $activitesreelle['Activitesreelle']['SA']!=0 ? $activitesreelle['Activitesreelle']['SA'] : ""; ?></td> 
                <td style="text-align: center;" class="week"><?php echo $activitesreelle['Activitesreelle']['DI']!=0 ? $activitesreelle['Activitesreelle']['DI'] : ""; ?></td> 
                <td style="text-align: center;"><?php echo $activitesreelle['Activitesreelle']['TOTAL']; ?></td> 
                <td style="text-align: center;">
                    <?php echo isset($activitesreelle['Activitesreelle']['action_id']) ? "<i class='icon-eye-open'></i>" : "<i class='icon-blank'></i>"; ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
                    <?php echo $this->Form->postLink('<i class="icon-thumbs-up"></i>', array('action' => 'validate', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir verrouiller cette feuille de temps ?')); ?>                    
                    <?php echo $this->Html->link('<i class=" icon-tags"></i>', array('action' => 'duplicate', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>                    
                </td>                 
            </tr>
        <?php $i++; ?>
            <?php //if (dateIsEqual($group['Activitesreelle']['DATE'],$activitesreelle['Activitesreelle']['DATE'])){ ?>
                <?php //echo $i." ".$activitesreelle['Activitesreelle']['DATE']." ".$activitesreelle['Utilisateur']['NOMLONG']." ".$activitesreelle['Activite']['NOM']; ?>
            
            <?php endif; ?>
        <?php endforeach; ?>
        <?php $r++; ?>
        <?php endforeach; ?>        
        </tbody>
	</table>
        <!--<div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class="pagination  pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => ''))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled'))."</li>";
	?>
        </ul>
	</div>  //-->      
</div>