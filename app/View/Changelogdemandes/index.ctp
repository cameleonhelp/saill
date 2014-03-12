<div class="">
    <?php echo $this->element('changelogsubmenu'); ?>
    <?php echo $this->element('changelognextversion'); ?>
    <div class="changelogdemandes index tablemarginright">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width:100%;">
	<tr>
                        <th style="border-bottom: 0px solid #000000 !important;width:80px;"><?php echo $this->Paginator->sort('id','Identifiant'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('Changelogversion.VERSION','Version'); ?></th>
                        <th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('DATEPREVUE','Prévue le'); ?></th>
                        <th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('CRITICITE','Criticité'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('utilisateur_id','Demandeur'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('OPEN','Ouverte'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('TYPE','Type de demande'); ?></th>
			<th style="border-bottom: 0px solid #000000 !important;"><?php echo $this->Paginator->sort('DEMANDE','Changement demandé'); ?></th>
			<th class="actions" style="border-bottom: 0px solid #000000 !important;"><?php echo __('Actions'); ?></th>
	</tr>
        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : '0';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : '1';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous';        
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 'tous';   
        $pass5 = isset($this->params->pass[5]) ? $this->params->pass[5] : 'tous'; 
        ?>           
        <tr>
                        <th style="border-top: 0px solid #000000 !important;"></th>
                        <th style="text-align:center;border-top: 0px solid #000000 !important;">
                            <div class="btn-group">
                                <button class="btn btn-default btn-xs dropdown-toggle<?php echo filtre_btn_is_actif($pass5,'tous'); ?>" type="button" data-toggle="dropdown"><span class="glyphicons filter size8"></span> <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li style="text-align:left;"><?php echo $this->Html->link("Toutes", array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,'tous'),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass5,'tous'))); ?></li>
                                  <li class="divider"></li>
                                  <?php foreach($versions as $version): ?>
                                    <li style="text-align:left;"><?php echo $this->Html->link($version['Changelogversion']['VERSION'], array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$pass4,$version['Changelogversion']['id']),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass5,$version['Changelogversion']['id']))); ?></li>
                                  <?php endforeach; ?>
                              </ul>
                            </div>                            
                        </th>
                        <th style="border-top: 0px solid #000000 !important;"></th>
                        <th style="text-align:center;border-top: 0px solid #000000 !important;">
                            <div class="btn-group">
                                <button class="btn btn-default btn-xs dropdown-toggle<?php echo filtre_btn_is_actif($pass2,'tous'); ?>" type="button" data-toggle="dropdown"><span class="glyphicons filter size8"></span> <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li style="text-align:left;"><?php echo $this->Html->link("Toutes", array('action' => 'index',$pass0,$pass1,"tous",$pass3,$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass2,'tous'))); ?></li>
                                  <li class="divider"></li>
                                  <?php foreach($changelogcriticites as $key=>$value): ?>
                                    <li style="text-align:left;"><?php echo $this->Html->link($value, array('action' => 'index',$pass0,$pass1,$key,$pass3,$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass2,$key))); ?></li>
                                  <?php endforeach; ?>
                              </ul>
                            </div>                            
                        </th>
			<th style="border-top: 0px solid #000000 !important;"></th>
			<th style="border-top: 0px solid #000000 !important;"></th>
			<th style="text-align:center;border-top: 0px solid #000000 !important;">
                            <div class="btn-group">
                                <button class="btn btn-default btn-xs dropdown-toggle<?php echo filtre_btn_is_actif($pass3,'tous'); ?>" type="button" data-toggle="dropdown"><span class="glyphicons filter size8"></span> <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li style="text-align:left;"><?php echo $this->Html->link("Tous", array('action' => 'index',$pass0,$pass1,$pass2,"tous",$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass3,'tous'))); ?></li>
                                  <li class="divider"></li>                                  
                                  <?php foreach($changelogetats as $key=>$value): ?>
                                    <li style="text-align:left;"><?php echo $this->Html->link($value, array('action' => 'index',$pass0,$pass1,$pass2,$key,$pass4,$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass3,$key))); ?></li>
                                  <?php endforeach; ?>
                              </ul>
                            </div>                            
                        </th>
                        <th style="text-align:center;border-top: 0px solid #000000 !important;">
                            <div class="btn-group">
                                <button class="btn btn-default btn-xs dropdown-toggle<?php echo filtre_btn_is_actif($pass4,'tous'); ?>" type="button" data-toggle="dropdown"><span class="glyphicons filter size8"></span> <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                  <li style="text-align:left;"><?php echo $this->Html->link("Tous", array('action' => 'index',$pass0,$pass1,$pass2,$pass3,"tous",$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass4,'tous'))); ?></li>
                                  <li class="divider"></li>                                  
                                  <?php foreach($changelogtypes as $key=>$value): ?>
                                    <li style="text-align:left;"><?php echo $this->Html->link($value, array('action' => 'index',$pass0,$pass1,$pass2,$pass3,$key,$pass5),array('class'=>'showoverlay'.subfiltre_btn_is_actif($pass4,$key))); ?></li>
                                  <?php endforeach; ?>
                              </ul>
                            </div>                            
                        </th>                        
			<th style="border-top: 0px solid #000000 !important;"></th>
			<th style="border-top: 0px solid #000000 !important;"></th>
	</tr>
	<?php foreach ($changelogdemandes as $changelogdemande): ?>
	<tr>
                <td><?php echo "C-".strYear($changelogdemande['Changelogdemande']['created'])."-".$changelogdemande['Changelogdemande']['id']; ?></td>
		<td>
			<?php echo $changelogdemande['Changelogversion']['VERSION']; ?>
		</td>
                <td><?php echo $changelogdemande['Changelogdemande']['DATEPREVUE']; ?></td>
                <td><?php echo $changelogcriticites[$changelogdemande['Changelogdemande']['CRITICITE']]; ?></td>
		<td>
			<?php echo $changelogdemande['Utilisateur']['NOMLONG']; ?>
		</td>
		<td style="text-align: center;"><?php $image = $changelogdemande['Changelogdemande']['OPEN']==1 ? 'unlock green' : 'lock red'; ?>
                    <?php if (userAuth('profil_id')=='1') : ?>
                    <a href="#" class="etat cursor showoverlay" data-id="<?php echo $changelogdemande['Changelogdemande']['id']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
                    <?php else: ?>
                    <span class="glyphicons <?php echo $image; ?> notchange"></span>
                    <?php endif; ?>
                </td>
		<td style="text-align: center;"><?php echo $changelogetats[$changelogdemande['Changelogdemande']['ETAT']]; ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo $changelogtypes[$changelogdemande['Changelogdemande']['TYPE']]; ?>&nbsp;</td>
		<td><?php echo $changelogdemande['Changelogdemande']['DEMANDE']; ?>&nbsp;</td>
		<td class="actions">
                    <a href="<?php echo $this->Html->url(array('controller'=>'changelogreponses','action'=>'view', $changelogdemande['Changelogdemande']['id'])); ?>">
                    <span class="glyphicons showoverlay comments notchange" style="position:relative;"><span style="position:absolute;color:white;top:2px;left:3.5px;font-weight:bold;;font-size:8px !important;"><?php echo $changelogdemande['Changelogdemande']['COUNT']; ?></span></span>
                    </a>
                    <?php if($changelogdemande['Changelogdemande']['OPEN']==1): ?>
                    <?php if (userAuth('profil_id')=='1') : ?>
			<?php echo $this->Html->link('<span class="glyphicons showoverlay conversation notchange"></span>', array('controller'=>'changelogreponses','action' => 'add', $changelogdemande['Changelogdemande']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                        <?php echo $this->Html->link('<span class="glyphicons showoverlay pencil notchange"></span>', array('action' => 'edit', $changelogdemande['Changelogdemande']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php if($changelogdemande['Changelogdemande']['changelogversion_id'] < 1 || $changelogdemande['Changelogdemande']['changelogversion_id']==null ): ?>
                        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $changelogdemande['Changelogdemande']['id']), array('escape' => false), __('Voulez vous vraiment supprimer cette demande ?')); ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </td>
	</tr>
<?php endforeach; ?>
	</table>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
        <div class="pull-right inverttablemarginright"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>   
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
</div>
<script>
$(document).ready(function () {
    $(document).on('click','.etat',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'changelogdemandes','action'=>'ajax_changeetat')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
});
</script>