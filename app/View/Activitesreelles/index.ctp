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
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('DATE'); ?></th>
                        <th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('LU'); ?></th>
			<th><?php echo $this->Paginator->sort('MA'); ?></th>
	<!--		<th><?php echo $this->Paginator->sort('ME'); ?></th>
			<th><?php echo $this->Paginator->sort('JE'); ?></th>
			<th><?php echo $this->Paginator->sort('VE'); ?></th>
			<th><?php echo $this->Paginator->sort('SA'); ?></th>
			<th><?php echo $this->Paginator->sort('DI'); ?></th>
			<th><?php echo $this->Paginator->sort('TOTAL'); ?></th>
			<th class="actions" width="90px"><?php echo __('Actions'); ?></th>//-->
	</tr>
	</thead>
        <tbody>   
        <?php foreach ($groups as $group) : ?>
        <?php $i = 0; ?>
        <?php foreach ($activitesreelles as $activitesreelle): ?>
            <tr>
                <td><?php echo $activitesreelle['Utilisateur']['NOMLONG']; ?></td>
                <td><?php echo $group['Activitesreelle']['DATE']; ?></td>
                <td><?php echo $activitesreelle['Activite']['NOM']; ?></td>  
                <td><?php echo $group['Activitesreelle']['NBACTIVITE']; ?></td> 
                <td><?php echo $i; ?></td> 
            </tr>
        <?php $i++; ?>
	
            <?php //if (dateIsEqual($group['Activitesreelle']['DATE'],$activitesreelle['Activitesreelle']['DATE'])){ ?>
                <?php //echo $i." ".$activitesreelle['Activitesreelle']['DATE']." ".$activitesreelle['Utilisateur']['NOMLONG']." ".$activitesreelle['Activite']['NOM']; ?>
            
            <?php //} ?>
        <?php endforeach; ?>
        <?php endforeach; ?>        
        </tbody>
	</table>
</div>
<?php debug($activitesreelles); ?>