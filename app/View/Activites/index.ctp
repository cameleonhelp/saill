<div class="activites index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Actif', array('action' => 'index','actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','actif'))); ?></li>
                         <li><?php echo $this->Html->link('Inactif', array('action' => 'index','inactif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','inactif'))); ?></li>
                     </ul>
                 </li>                 
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Projets <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'))); ?></li>
                     <li><?php echo $this->Html->link('Autres que indisponibilité', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','autres'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','autres'))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($projets as $projet): ?>
                            <li><?php echo $this->Html->link($projet['Projet']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$projet['Projet']['id']),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$projet['Projet']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                   
                <li class="divider-vertical-only"></li>                
                <li><?php echo $this->Html->link('<span class="ico-xls"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
                </ul> 
                <?php echo $this->Form->create("Activite",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20"><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> sur <?php echo $fprojet; ?></em></div><?php } ?>        
        <div class="marginright10">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('Projet.NOM','Projet'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
			<th width="90px;"><?php echo $this->Paginator->sort('DATEDEBUT','Début'); ?></th>
			<th width="90px;"><?php echo $this->Paginator->sort('DATEFIN','Fin'); ?></th>
			<th><?php echo $this->Paginator->sort('NUMEROGALLILIE','Réf. GALILEI'); ?></th>
			<th><?php echo $this->Paginator->sort('BUDJETRA','Budget initial'); ?></th>
			<th><?php echo $this->Paginator->sort('BUDGETREVU','Dernier budget'); ?></th>
			<th width="50px;"><?php echo $this->Paginator->sort('ACTIVE','Etat'); ?></th>
			<th width="60px;" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
        <?php if (isset($activites)): ?>            
	<?php foreach ($activites as $activite): ?>
	<tr>
		<td><?php echo h($activite['Projet']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($activite['Activite']['NOM']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($activite['Activite']['DATEDEBUT']); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h($activite['Activite']['DATEFIN']); ?>&nbsp;</td>
		<td style="text-align: right;"><?php echo h($activite['Activite']['NUMEROGALLILIE']); ?>&nbsp;</td>
		<td style="text-align: right;" class="budgetprevu"><?php echo h(isset($activite['Activite']['BUDJETRA']) ? $activite['Activite']['BUDJETRA'] : '0'); ?> k€&nbsp;</td>
		<td style="text-align: right;" class="budgetrevu"><?php echo h(isset($activite['Activite']['BUDGETREVU']) ? $activite['Activite']['BUDGETREVU'] : '0'); ?> k€&nbsp;</td>
		<td style="text-align: center;"><?php echo $activite['Activite']['ACTIVE']==1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
		<td class="actions">
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'view')) : ?>
                        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Activité :</h3>" data-content="<contenttitle>Description: </contenttitle>'.h($activite['Activite']['DESCRIPTION']).'<br/><contenttitle>Crée le: </contenttitle>'.h($activite['Activite']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($activite['Activite']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                        <?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'edit')) : ?>
                        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $activite['Activite']['id']),array('escape' => false,'class'=>'showoverlay')); ?>&nbsp;
			<?php endif; ?>
                        <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'delete')) : ?>
                        <?php echo ($activite['Activite']['DELETABLE']==1) ? $this->Form->postLink('<span class="glyphicons showoverlay bin notchange"></span>', array('action' => 'delete', $activite['Activite']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette activité ?')):''; ?>                    
                        <?php endif; ?>
                </td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
	<tr>
            <td colspan="5" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalprevu" style="text-align:right;"></td>
            <td class="footer" id="totalrevu" style="text-align:right;"></td>
            <td class="footer" colspan="2" style="text-align:left;"></td>
	</tr>            
        </tfooter>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right marginright20"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
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
</div>
<script>
    function sumOfColumns(attr,suffixe) {
        var tot = 0;
        $("."+attr).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2)+" "+suffixe;
     }
     
     $(document).ready(function () {
        $("#totalprevu").html(sumOfColumns('budgetprevu','k€'));
        $("#totalrevu").html(sumOfColumns('budgetrevu','k€'));
     });
</script>
