<div class="materielinformatiques index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($etats as $etat): ?>
                            <li><?php echo $this->Html->link($etat['Materielinformatique']['ETAT'], array('action' => 'index',$etat['Materielinformatique']['ETAT'],isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>   
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Type de matériel <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($types as $type): ?>
                            <li><?php echo $this->Html->link($type['Typemateriel']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$type['Typemateriel']['NOM'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>  
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Sections <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Toutes', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','toutes')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($sections as $section): ?>
                            <li><?php echo $this->Html->link($section['Section']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$section['Section']['id'])); ?></li>
                         <?php endforeach; ?>
                      </ul>
                 </li>                   
                <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls icon-top2"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>               
                </ul> 
                <?php echo $this->Form->create("Materielinformatique",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                </div>
            </div>
        </div>
       <?php if($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des postes informatiques <?php echo $fetat; ?>, de <?php echo $ftype; ?> et étant affectés à <?php echo $fsection; ?></em></code><?php } ?>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
                        <th width="17px">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('typemateriel_id','Type de matériel'); ?></th>
			<th><?php echo $this->Paginator->sort('section_id','Section'); ?></th>
			<th><?php echo $this->Paginator->sort('assistance_id','Assistance'); ?></th>
                        <th width="40px;"><?php echo $this->Paginator->sort('WIFI','Wifi'); ?></th>
			<th width="40px;"><?php echo $this->Paginator->sort('VPN','Accès distant'); ?></th>
			<th><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
                        <th class="actions" width="75px;"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php if (isset($materielinformatiques)): ?>
	<?php foreach ($materielinformatiques as $materielinformatique): ?>
	<tr>
		<td><?php echo h($materielinformatique['Materielinformatique']['NOM']); ?>&nbsp;</td>
                <td style='text-align:center;'><span id="pingthishost" data-host="<?php echo h($materielinformatique['Materielinformatique']['NOM']); ?>" class="glyphicons grey radar size14 cursor showoverlay"></span></td>
		<td><?php echo h($materielinformatique['Typemateriel']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($materielinformatique['Section']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($materielinformatique['Assistance']['NOM']); ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($materielinformatique['Materielinformatique']['WIFI'])==1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
		<td style='text-align:center;'><?php echo h($materielinformatique['Materielinformatique']['VPN'])==1 ? '<span class="glyphicons ok_2"></span>' : ''; ?>&nbsp;</td>
                <td style='text-align:center;'><span class="glyphicons <?php echo etatMaterielInformatiqueImage(h($materielinformatique['Materielinformatique']['ETAT'])); ?>" rel="tooltip" data-title="<?php echo h($materielinformatique['Materielinformatique']['ETAT']); ?>"></span>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'view')) : ?>
                    <?php $utilisateur = isset($materielinformatique['Materielinformatique']['utilisateur_NOMLONG']) ? $materielinformatique['Materielinformatique']['utilisateur_NOMLONG'] : ""; ?>
                    <?php echo '<span class="glyphicons eye_open" rel="popover" data-title="<h3>Poste informatique :</h3>" data-content="<contenttitle>Affecté à : </contenttitle>'.$utilisateur.'<br/><contenttitle>Commentaire: </contenttitle>'.h($materielinformatique['Materielinformatique']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($materielinformatique['Materielinformatique']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($materielinformatique['Materielinformatique']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil"></span>', array('action' => 'edit', $materielinformatique['Materielinformatique']['id']),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin"></span>', array('action' => 'delete', $materielinformatique['Materielinformatique']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce poste informatique ?')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons retweet"></span>', array('action' => 'dupliquer', $materielinformatique['Materielinformatique']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce poste informatique ?')); ?>
                    <?php endif; ?>                    
		</td>
	</tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>    
	<div class="pagination pagination-centered">
        <ul>
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay'))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabledshowoverlay'))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay'))."</li>";
	?>
        </ul>
	</div>
</div>
<script>
     $(document).ready(function () {
        
        function hideoverlay(){
            var overlay = $('#overlay');
            overlay.hide();
        }
         
        $(document).on('click','#pingthishost',function(e){
            var host = $(this).attr('data-host');
            var $this = $(this);
            $(this).removeClass('red').removeClass('green').removeClass('grey');
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'materielinformatiques','action'=>'pinghost')); ?>/"+host,
                contentType: "application/json",
                success: function(response) {
                    var json = $.parseJSON(response);
                    var color = 'red'; 
                    if(json.LATENCE != false){color ='green'};
                    $this.addClass(color);
                    hideoverlay();
                },
                error: function(response,status,errorThrown) {
                    var color = 'red'; 
                    $this.addClass(color);
                    hideoverlay();
                }
             });
        });
    });
</script>