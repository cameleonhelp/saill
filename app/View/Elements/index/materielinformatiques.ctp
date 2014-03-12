<nav class="navbar toolbar ">
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => 'index','tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($etats as $key=>$value): ?>
                    <li><?php echo $this->Html->link($value, array('action' => 'index',$key,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$key))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>   
        <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Type de matériel <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($types as $type): ?>
                    <li><?php echo $this->Html->link($type['Typemateriel']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',$type['Typemateriel']['NOM'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$type['Typemateriel']['NOM']))); ?></li>
                 <?php endforeach; ?>
              </ul>
        </li>  
        <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','toutes'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Sections <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Toutes', array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','toutes'),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes','toutes'))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($sections as $section): ?>
                    <li><?php echo $this->Html->link($section['Section']['NOM'], array('action' => 'index',isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',$section['Section']['id']),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'toutes',$section['Section']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
         </li>                   
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('<span class="ico-xls"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>               
        </ul> 
        <?php echo $this->Form->create("Materielinformatique",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
        <?php echo $this->Form->end(); ?>                     
</nav>
<?php if($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 "><strong>Filtre appliqué : </strong><em>Liste des postes informatiques <?php echo $fetat; ?>, de <?php echo $ftype; ?> et étant affectés à <?php echo $fsection; ?></em></div><?php } ?>
<div class="">   
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
                <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $materielinformatique['Materielinformatique']['id']),array('escape' => false)); ?>&nbsp;
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'delete')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $materielinformatique['Materielinformatique']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce poste informatique ?')); ?>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'duplicate')) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons retweet notchange"></span>', array('action' => 'dupliquer', $materielinformatique['Materielinformatique']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer ce poste informatique ?')); ?>
            <?php endif; ?>                    
        </td>
</tr>
<?php $utilisateur = isset($materielinformatique['Materielinformatique']['utilisateur_NOMLONG']) ? $materielinformatique['Materielinformatique']['utilisateur_NOMLONG'] : ""; ?>
<tr class="trhidden" style="display:none;">
    <td colspan="9" align="center">
        <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
            <tr><th>Affecté à</th><th>Commentaire</th></tr>
            <tr><td><?php echo $utilisateur; ?></td><td><?php echo $materielinformatique['Materielinformatique']['COMMENTAIRE']; ?></td></tr>
        </table>
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
        $(document).on('click','.eye_open',function(e){
            $(this).parents('tr').next('.trhidden').slideToggle("slow");
        });

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
                    if(json.RETOUR == true){color ='green'};
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