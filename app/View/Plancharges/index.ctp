<div class="plancharges index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre années <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($annees as $annee) : ?>
                            <li><?php echo $this->Html->link($annee['Plancharge']['ANNEE'], array('action' => 'index',$annee['Plancharge']['ANNEE'],isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre contrats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous')); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($contrats as $contrat) : ?>
                            <li><?php echo $this->Html->link($contrat['Contrat']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$contrat['Plancharge']['contrat_id'])); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li> 
                </ul> 
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fannee; ?>, <?php echo $fprojet; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('ANNEE','Année'); ?></th>
                        <th><?php echo $this->Paginator->sort('Contrat.NOM','Contrat'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM','Nom du plan de charge'); ?></th>
			<th><?php echo $this->Paginator->sort('ETP','etp'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGES','Charges'); ?></th>
			<th><?php echo $this->Paginator->sort('TJM','tjm'); ?></th>
			<th><?php echo $this->Paginator->sort('VERSION','Version'); ?></th>
			<th class="actions"  width="80px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>        
	<?php foreach ($plancharges as $plancharge): ?>
	<tr>
		<td style='text-align:center;'><?php echo h($plancharge['Plancharge']['ANNEE']); ?>&nbsp;</td>
                <td><?php echo h($plancharge['Contrat']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['NOM']); ?>&nbsp;</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['ETP']); ?>&nbsp;</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['CHARGES']); ?>&nbsp;j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['TJM']); ?>&nbsp;€/j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['VERSION']); ?>&nbsp;</td>
		<td>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Plan de charge :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($plancharge['Plancharge']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($plancharge['Plancharge']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                    <?php echo $this->Html->link('<i class="icon-th-list"></i>', array('controller'=>'detailplancharges','action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?> 
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo $this->Html->link('<i class="icon-list-alt"></i>', array('action' => 'export_xls', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>                    
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
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
	</div>
</div>

