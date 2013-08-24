<div class="plancharges index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php 
                $filtre_visible = isset($this->params->pass[2]) ? $this->params->pass[2] : 1;
                if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre années <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$filtre_visible)); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($annees as $annee) : ?>
                            <li><?php echo $this->Html->link($annee['Plancharge']['ANNEE'], array('action' => 'index',$annee['Plancharge']['ANNEE'],isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$filtre_visible)); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre contrats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',$filtre_visible)); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($contrats as $contrat) : ?>
                            <li><?php echo $this->Html->link($contrat['Contrat']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$contrat['Plancharge']['contrat_id'],$filtre_visible)); ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtres ... <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <?php
                     $inserse_visible = $filtre_visible == 0 ? 1 : 0;
                     $img_visible = $filtre_visible == 1 ? "unchecked bottom2" : "check bottom2";
                     ?>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_visible.'"></span> Non visible inclus ', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$inserse_visible),array('escape' => false)); ?></li>
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
                        <th width="60px"><?php echo 'Visible'; ?></th>
			<th class="actions"  width="80px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>        
	<?php if (isset($plancharges)): ?>
	<?php foreach ($plancharges as $plancharge): ?>
	<tr>
		<td style='text-align:center;'><?php echo h($plancharge['Plancharge']['ANNEE']); ?>&nbsp;</td>
                <td><?php echo h($plancharge['Contrat']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($plancharge['Plancharge']['NOM']); ?>&nbsp;</td>
		<td style='text-align:right;' class="etprow"><?php echo h($plancharge['Plancharge']['ETP']); ?>&nbsp;</td>
		<td style='text-align:right;' class="chargerow"><?php echo h($plancharge['Plancharge']['CHARGES']); ?>&nbsp;j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['TJM']); ?>&nbsp;€/j</td>
		<td style='text-align:right;'><?php echo h($plancharge['Plancharge']['VERSION']); ?>&nbsp;</td>               
		<td style="text-align:center;" nowrap><?php $image = (isset($plancharge['Plancharge']['VISIBLE']) && $plancharge['Plancharge']['VISIBLE']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                    <a href="#" class="isvisible cursor" idplancharge="<?php echo $plancharge['Plancharge']['id']; ?>" ><span class="glyphicons <?php echo $image; ?>" rel="tooltip" data-title="Plan de charge visible ou non"></span></a></td>               
                <td>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" rel="popover" data-title="<h3>Plan de charge :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($plancharge['Plancharge']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($plancharge['Plancharge']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil" rel="tooltip" data-title="Créer une nouvelle version"></span>', array('action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'add')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons array" rel="tooltip" data-title="Modification"></span>', array('controller'=>'detailplancharges','action' => 'edit', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?> 
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'view')) : ?>
                    <?php echo $this->Html->link('<span class="ico-xls icon-top2" rel="tooltip" data-title="Export Excel"></span>', array('action' => 'export_xls', $plancharge['Plancharge']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfooter>
            <tr>
                <td class="footer" colspan="3" style="text-align:right;">Total</td>
                <td class="footer" style="text-align:right;" id="totaletp">0</td>
                <td class="footer" style="text-align:right;" id="totalcharges">0</td>
                <td class="footer" colspan="4">&nbsp;</td>  
            </tr>
        </tfooter>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class="pagination  pagination-centered showoverlay">
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
<script>
    function sumOfETP() {
        var tot = 0;
        $(".etprow").each(function() {
          tot += parseFloat($(this).html());
        });
        return parseFloat(tot).toFixed(2);
     }
    function sumOfCharges() {
        var tot = 0;
        $(".chargerow").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot+" j";
     }     
     $(document).ready(function () {
        $("#totaletp").html(sumOfETP());
        $("#totalcharges").html(sumOfCharges());
        
    $(document).on('click','.isvisible',function(e){
        var id = $(this).attr('idplancharge');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'plancharges','action'=>'isvisible')); ?>/"+id,
            data: ({})
        }).done(function ( data ) {
            location.reload();
        });
    });          
    });
</script>