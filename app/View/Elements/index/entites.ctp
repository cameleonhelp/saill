<nav class="navbar toolbar ">
        <?php 
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Entite']['SEARCH'];
        elseif (isset($this->params->pass[0]) && $this->params->pass[0] !=''):
            $keyword = $this->params->pass[0];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>    
        <ul class="nav navbar-nav toolbar">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('entites', 'add')) : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
        <?php endif; ?>                 
        </ul> 
        <ul class="nav navbar-nav toolbar pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Entite",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
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
<thead><tr>
    <th><?php echo $this->Paginator->sort('NOM','Nom'); ?></th>
    <th><?php echo $this->Paginator->sort('COMMENTAIRE','Commentaire'); ?></th>
    <th><?php echo $this->Paginator->sort('MAILGESTENV','Gestionnaire des environnements'); ?></th>
    <th class="actions"><?php echo __('Périmètre'); ?></th>
    <th class="actions"><?php echo __('Actions'); ?></th>
</tr></thead>   
<?php foreach ($entites as $entite): ?>
<tr>
    <td><?php echo $entite['Entite']['NOM']; ?>&nbsp;</td>
    <td><?php echo $entite['Entite']['COMMENTAIRE']; ?>&nbsp;</td>
    <td><?php echo h($entite['Entite']['MAILGESTENV']); ?>&nbsp;</td>
    <td class="actions">
        <?php $countu = $this->requestAction('assoentiteutilisateurs/count/'.$entite['Entite']['id']); ?>
        <?php $green = $countu > 0 ? 'green btn-success' : 'btn-grey'; ?>
        <?php echo $this->Html->link('<span class="btn btn-xs badgeaction '.$green.'" style="color:white !important;"><span class="glyphicons group white notchange"></span>&nbsp;&nbsp;'.$countu.'</span>', array('action' => '#'),array('escape' => false,"data-entite"=>$entite['Entite']['id'] )); ?>
        <?php $countp = $this->requestAction('assoprojetentites/count/'.$entite['Entite']['id']); ?>
        <?php $green = $countp > 0 ? 'green btn-success' : 'btn-grey' ?>
        <?php echo $this->Html->link('<span class="btn btn-xs badgeprojet '.$green.'"><span class="glyphicons share_alt white notchange"></span>&nbsp;&nbsp;'.$countp.'</span>', array('action' => '#'),array('escape' => false, "data-entite"=>$entite['Entite']['id'])); ?>
    </td>
    <td class="actions">
        <?php if (userAuth('profil_id')!='2' && isAuthorized('entites', 'view')) : ?>
        <?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Cercle de visibilité :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($entite['Entite']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($entite['Entite']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?>&nbsp;
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('entites', 'edit')) : ?>
        <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('action' => 'edit', $entite['Entite']['id']),array('escape' => false)); ?>
        <?php endif; ?>
        <?php if (userAuth('profil_id')!='2' && isAuthorized('entites', 'delete')) : ?>
        <?php if($countu == 0 && $countp == 0): ?>
        <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $entite['Entite']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce cercle de visibilité et ces dépendances ?')); ?>                    
        <?php endif; ?>   
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
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
<!-- DEBUT FENETRE MODALE -->
<div class="modal fade" id="modalusers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo 'Liste des agents'; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <div class="form-group">
               <?php echo $this->Form->select('filtresection',$list_sections,array('class'=>'form-control','default'=>'','id'=>'filtresection','empty'=>'Toutes les sections')); ?>
            </div>            
            <div class="form-group">
                    <?php echo $this->Form->input('filtreuser',array('class'=>'form-control','type'=>'text','id'=>'filtreuser','placeholder'=>'Filtre')); ?>
            </div>            
            <?php echo $this->Form->create('Assoentiteutilisateur',array('action'=>'save','id'=>'formValidate','class'=>'form-horizontal','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <div id="AssoentiteutilisateurCounter" class="pull-right"></div>
            <br>
            <ul class="list-group overflow" id="listuser">
              <?php foreach($all_utilisateurs as $obj): ?>
                <li class="list-group-item list-user-item" data-section="<?php echo $obj['Utilisateur']['section_id']; ?>" data-id="<?php echo $obj['Utilisateur']['id']; ?>"><?php echo $obj['Utilisateur']['NOMLONG']; ?></li>
              <?php endforeach; ?>
            </ul>
            <div style='text-align:center;margin-top:20px !important;'>
            <button  type="button" class="btn btn-sm btn-default selectalluser">Tout sélectionner</button>&nbsp;<button  type="button" class="btn btn-sm btn-default unselectalluser">Tout désélectionner</button>
            </div>
            <input type="hidden" id="AssoentiteutilisateurUtilisateursId" name="data[Assoentiteutilisateur][utilisateurs_id]"> 
            <?php echo $this->Form->input('entite_id',array('type'=>'hidden')); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalusers">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodalusers">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>          
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalprojets" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo 'Liste des projets'; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <div class="form-group">
                    <?php echo $this->Form->input('filtreprojet',array('class'=>'form-control','type'=>'text','id'=>'filtreprojet','placeholder'=>'Filtre')); ?>
            </div>
            <?php echo $this->Form->create('Assoprojetentite',array('action'=>'save','id'=>'formValidate','class'=>'form-horizontal','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <div id="AssoprojetentiteCounter" class="pull-right"></div>
            <br>
            <ul class="list-group overflow" id="listprojet">
              <?php foreach($all_projets as $obj): ?>
                <li class="list-group-item list-projet-item" data-id="<?php echo $obj['Projet']['id']; ?>"><?php echo $obj['Projet']['NOM']; ?></li>
              <?php endforeach; ?>
            </ul>
            <div style='text-align:center;margin-top:20px !important;'>
            <button  type="button" class="btn btn-sm btn-default selectallprojet">Tout sélectionner</button>&nbsp;<button  type="button" class="btn btn-sm btn-default unselectallprojet">Tout désélectionner</button>
            </div>
            <input type="hidden" id="AssoprojetentiteProjetsId" name="data[Assoprojetentite][projets_id]"> 
            <?php echo $this->Form->input('entite_id',array('type'=>'hidden')); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalprojets">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodalprojets">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>          
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- FIN FENETRE MODALE -->
<script>
$(document).ready(function () {
    var listuser = [];
    var listprojet = [];

    $("#AssoentiteutilisateurCounter").text(listuser.length + " élément sélectionné");
    $("#AssoprojetentiteCounter").text(listprojet.length + " élément sélectionné");

    $(document).on("click",".list-user-item",function() {
        if($(this).hasClass('active')){
          listuser.splice($.inArray($(this).attr("data-id"), listuser),1);
          $(this).removeClass('active');
        } else {
          listuser.push($(this).attr("data-id"));
          $(this).addClass('active');
        }
        $("#AssoentiteutilisateurUtilisateursId").val(listuser.sort().join());
        $("#AssoentiteutilisateurCounter").text(listuser.length + " éléments sélectionnés");
    });

    $(document).on("click",".selectalluser",function() {
        //listuser = [];
        $( ".list-user-item" ).each(function( index ) {
          if($(this).is(':visible') && !$(this).hasClass('active')){
            listuser.push($(this).attr("data-id"));
            $(this).addClass('active');
          }
        });
        $("#AssoentiteutilisateurUtilisateursId").val(listuser.sort().join());
        $("#AssoentiteutilisateurCounter").text(listuser.length + " éléments sélectionnés");
    });

    $(document).on("click",".unselectalluser",function() {
        listuser = [];
        $( ".list-user-item" ).each(function( index ) {
          $(this).removeClass('active');
        $("#AssoentiteutilisateurUtilisateursId").val(listuser.sort().join());
        $("#AssoentiteutilisateurCounter").text(listuser.length + " élément sélectionné");
        });
    });
    
    $(document).on("click",".list-projet-item",function() {
        if($(this).hasClass('active')){
          listprojet.splice($.inArray($(this).attr("data-id"), listprojet),1);
          $(this).removeClass('active');
        } else {
          listprojet.push($(this).attr("data-id"));
          $(this).addClass('active');
        }
        $("#AssoprojetentiteProjetsId").val(listprojet.sort().join());
        $("#AssoprojetentiteCounter").text(listprojet.length + " éléments sélectionnés");
    });

    $(document).on("click",".selectallprojet",function() {
        $( ".list-projet-item" ).each(function( index ) {
          if($(this).is(':visible') && !$(this).hasClass('active')){
            listprojet.push($(this).attr("data-id"));
            $(this).addClass('active');
          }
        });
        $("#AssoprojetentiteProjetsId").val(listprojet.sort().join());
        $("#AssoprojetentiteCounter").text(listprojet.length + " éléments sélectionnés");
    });

    $(document).on("click",".unselectallprojet",function() {
        listprojet = [];
        $( ".list-projet-item" ).each(function( index ) {
          $(this).removeClass('active');
        $("#AssoprojetentiteProjetsId").val(listprojet.sort().join());
        $("#AssoprojetentiteCounter").text(listprojet.length + " élément sélectionné");
        });
    });   
    
    jQuery.expr[':'].Contains = function(a,i,m){
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
    };
     
    $(document).on("change","#filtresection",function() {
        var filter = $(this).val();
        var list = $('#listuser');
        if (filter) {
            $(list).find("li").slideUp();
            $(list).find("li[data-section=" + filter + "]").slideDown();
        } else {
            $(list).find("li").slideDown();
        }        
    });

    $(document).on("keyup change",'#filtreuser', function() {
        var filter = $(this).val();
        var list = $('#listuser');
        if (filter) {
          $(list).find("li:not(:Contains(" + filter + "))").slideUp();
          $(list).find("li:Contains(" + filter + ")").slideDown();
        } else {
          $(list).find("li").slideDown();
        }
    });
  
    $(document).on("keyup change",'#filtreprojet', function() {
        var filter = $(this).val();
        var list = $('#listprojet');
        if (filter) {
          $(list).find("li:not(:Contains(" + filter + "))").slideUp();
          $(list).find("li:Contains(" + filter + ")").slideDown();
        } else {
          $(list).find("li").slideDown();
        }
    });  
    
    $(document).on('click','#closemodalusers',function(e){
        $('#modalusers').modal('hide');
    });    
    
    $(document).on('click','.badgeaction',function(e){
        var id = $(this).parents('a').attr('data-entite');
        $('#AssoentiteutilisateurEntiteId').val(id);
        $('#modalusers').modal('show');
        return false;
    });
    
    $('#modalusers').on('hidden.bs.modal', function (e) {
         $('#AssoentiteutilisateurEntiteId').val('');
         $("#AssoentiteutilisateurUtilisateursId").val('');
    });
    
    $('#modalusers').on('shown.bs.modal', function (e) {
        $(".list-user-item").removeClass('active');
        listuser = [];
        //récupération en base des utilisateurs associés
        var id = $('#AssoentiteutilisateurEntiteId').val();
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'assoentiteutilisateurs','action'=>'json_get_users')); ?>/"+id,
            data: {},  
            contentType: "application/json",
        }).done(function(data){
            $("#AssoentiteutilisateurUtilisateursId").val(data);
            //récupération des environnements à partir du champs caché
            var environnements = data;
            //convertir en array
            if(environnements !='') { listuser = environnements.split(","); }
            //pour chaque éléments si data-id exist alors on ajout la classe active
            $.each(listuser, function( index, value ) {
                var exist = false;
                $.each($(".list-user-item"), function() {
                  if(value && $(this).attr("data-id") == value){
                    $(this).addClass('active');
                    exist = true;
                  }
                }); 
                if (!exist && value){
                    listuser = $.grep(listuser,function(list){
                        return list != value;
                    });
                    $("#AssoentiteutilisateurUtilisateursId").val(listuser.sort().join());
                }

            });
            $("#AssoentiteutilisateurCounter").text(listuser.length + " éléments sélectionnés");
        });
    });
    
    $(document).on('click','#closemodalprojets',function(e){
        $('#modalprojets').modal('hide');
    });   
    
    $(document).on('click','.badgeprojet',function(e){
        var id = $(this).parents('a').attr('data-entite');
        $('#AssoprojetentiteEntiteId').val(id);
        $('#modalprojets').modal('show');
        return false;
    });
    
    $('#modalprojets').on('hidden.bs.modal', function (e) {
         $('#AssoprojetentiteEntiteId').val('');
         $("#AssoprojetentiteProjetsId").val('');
    });    
    
    $('#modalprojets').on('shown.bs.modal', function (e) {
        $(".list-projet-item").removeClass('active');
        listprojet = [];
        //récupération en base des utilisateurs associés
        var id = $('#AssoprojetentiteEntiteId').val();
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'assoprojetentites','action'=>'json_get_projets')); ?>/"+id,
            data: {},  
            contentType: "application/json",
        }).done(function(data){
            $("#AssoprojetentiteProjetsId").val(data);
            //récupération des environnements à partir du champs caché
            var environnements = data;
            //convertir en array
            if(environnements !='') { listprojet = environnements.split(","); }
            //pour chaque éléments si data-id exist alors on ajout la classe active
            $.each(listprojet, function( index, value ) {
                var exist = false;
                $.each($(".list-projet-item"), function() {
                  if(value && $(this).attr("data-id") == value){
                    $(this).addClass('active');
                    exist = true;
                  }
                }); 
                if (!exist && value){
                    listprojet = $.grep(listprojet,function(list){
                        return list != value;
                    });
                    $("#AssoprojetentiteProjetsId").val(listprojet.sort().join());
                }

            });
            $("#AssoprojetentiteCounter").text(listprojet.length + " éléments sélectionnés");
        });
    });
    
        $(document).on('keyup','#EntiteSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>entites/search/";
            $(this).parents('form').attr('action',url+$(this).val());
        }); 
});
</script>