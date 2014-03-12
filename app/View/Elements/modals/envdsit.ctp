<?php $modaltitle = "Liste des environnements DSI-T"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalenvdsit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
            <div class="form-group">
               <?php echo $this->Form->input('filtreenv',array('class'=>'form-control','type'=>'text','id'=>'filtreenv','placeholder'=>'Filtre')); ?>
            </div>            
            <div id="Counter" class="pull-right"></div>
            <br>
            <ul class="list-group overflow" id="listenvs">
              <?php foreach($all_dsitenvs as $obj): ?>
                <li class="list-group-item list-env-item" data-app="<?php echo $obj['Dsitenv']['application_id']; ?>" data-id="<?php echo $obj['Dsitenv']['id']; ?>" data-nom="<?php echo $obj['Dsitenv']['NOM']; ?>"><?php echo $obj['Dsitenv']['NOM'].' ('.$obj['Application']['NOM'].')'; ?></li>
              <?php endforeach; ?>
            </ul>
            <div style='text-align:center;margin-top:20px !important;'>
            <button  type="button" class="btn btn-sm btn-default selectall">Tout sélectionner</button>&nbsp;<button  type="button" class="btn btn-sm btn-default unselectall">Tout désélectionner</button>
            </div>
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <!--mettre en champs cachés les valeurs nécessaires à l'enregistrement-->
      <input type='hidden' id='assoid' />
      <input type='hidden' id='envsid' />
      <input type='hidden' id='tospan' />
      <button type="button" class="btn btn-sm btn-default" id="closemodalenvdsit">Annuler</button><button type="submit" class="btn btn-sm btn-primary" id="savemodalenvdsit">Enregistrer</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
    jQuery.expr[':'].Contains = function(a,i,m){
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
    };
    
    var listenvs = [];

    $("#Counter").text(listenvs.length + " éléments sélectionnés");
        
    $('#modalenvdsit').on('show.bs.modal', function (e) {
        $(".list-env-item").removeClass('active');
        //récupération des environnements à partir du champs caché
        var environnements = $("#envsid").val();
        //convertir en array
        if(environnements) { listenvs = environnements.split(",");console.log($(".list-env-item").attr("data-id")); }
        //pour chaque éléments si data-id exist alors on ajout la classe active
        $.each(listenvs, function( index, value ) {
            var exist = false;
            $.each($(".list-env-item"), function() {
              if(value && $(this).attr("data-id") == value){
                $(this).addClass('active');
                exist = true;
              }
            }); 
            if (!exist && value){
                listenvs = $.grep(listenvs,function(list){
                    return list != value;
                });
                $("#envsid").val(listenvs.sort().join());
            }
            
        });
        $("#Counter").text(listenvs.length + " éléments sélectionnés");
    });
    
    $('#modalenvdsit').on('shown.bs.modal', function (e) {
        $(".list-env-item").removeClass('active');  
        //pour chaque éléments si data-id exist alors on ajout la classe active
        $.each(listenvs, function( index, value ) {
            var exist = false;
            $.each($(".list-env-item"), function() {
              if(value && $(this).attr("data-id") == value){
                $(this).addClass('active');
                exist = true;
              }
            }); 
            if (!exist && value){
                listenvs = $.grep(listenvs,function(list){
                    return list != value;
                });
                $("#envsid").val(listenvs.sort().join());
            }
            
        });
        $("#Counter").text(listenvs.length + " éléments sélectionnés");    
    });
    
    $('#modalenvdsit').on('hidden.bs.modal', function (e) {
      listenvs = [];      
    });
    
    $(document).on("keyup change",'#filtreenv', function() {
        var filter = $(this).val();
        var list = $('#listenvs');
        if (filter) {
          $(list).find("li:not(:Contains(" + filter + "))").slideUp();
          $(list).find("li:Contains(" + filter + ")").slideDown();
        } else {
          $(list).find("li").slideDown();
        }
    });    

    $(document).on("click",".list-env-item",function() {
        if($(this).hasClass('active')){
          listenvs.splice($.inArray($(this).attr("data-id"), listenvs),1);
          $(this).removeClass('active');
        } else {
          listenvs.push($(this).attr("data-id"));
          $(this).addClass('active');
        }
        $("#envsid").val(listenvs.sort().join());
        $("#Counter").text(listenvs.length + " éléments sélectionnés");
    });

    $(document).on("click",".selectall",function() {
        $( ".list-env-item" ).each(function( index ) {
          if($(this).is(':visible') && !$(this).hasClass('active')){
            listenvs.push($(this).attr("data-id"));
            $(this).addClass('active');
          }
        });
        $("#envsid").val(listenvs.sort().join());
        $("#Counter").text(listenvs.length + " éléments sélectionnés");
    });

    $(document).on("click",".unselectall",function() {
        listenvs = [];
        $( ".list-env-item" ).each(function( index ) {
          $(this).removeClass('active');
          $("#envsid").val(listenvs.sort().join());
          $("#Counter").text(listenvs.length + " élément sélectionné");
        });
    });  
    $(document).on('click','#closemodalenvdsit',function(e){
        $('#modalenvdsit').modal('toggle');
    });    
    
    $(document).on('click','#savemodalenvdsit',function(){
       $("#NBENVIRONNEMENTS").text(listenvs.length);
       var spanid = $("#tospan").val();
       var list = $('#listenvs');
       var envs = [];
       var envids = [];
       $( ".list-env-item" ).each(function( index ) {
          if($(this).hasClass('active')){
            envs.push($(this).attr('data-nom'));
            envids.push($(this).attr('data-id'));
          }
      });
      $("a[data-span='"+spanid.substr(1)+"']").attr("data-envid",envids.join(','));
      $(spanid).text(envs.join(','));  
       var id = $('#assoid').val();
       $.ajax({
           dataType: "html",
           type: "POST",
           url: "<?php echo $this->Html->url(array('controller'=>'assobienlogiciels','action'=>'ajaxupdateenv')); ?>/",
           data: ({id:id,dsitenvid:envids.join(',')})
       }).done(function ( data ) {
           location.reload();
       });
       $('#modalenvdsit').modal('toggle');
       return true;      
      //ajax pour mettre à jour le champs dsitenv_id en base à partir des valeurs envids.join(',')
      
    });
});
</script>