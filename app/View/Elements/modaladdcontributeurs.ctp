<?php $modaltitle = "Liste des contributeurs"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdcontributeurs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
               <?php echo $this->Form->select('filtresection',$list_sections,array('class'=>'form-control','default'=>'','id'=>'filtresection','empty'=>'Toutes les sections')); ?>
            </div>  
            ou
            <div class="form-group">
               <?php echo $this->Form->input('filtreuser',array('class'=>'form-control','type'=>'text','id'=>'filtreuser','placeholder'=>'Filtre')); ?>
            </div>            
            <div id="Counter" class="pull-right"></div>
            <br>
            <ul class="list-group overflow" id="listuser">
              <?php foreach($all_utilisateurs as $obj): ?>
                <li class="list-group-item list-user-item" data-section="<?php echo $obj['Utilisateur']['section_id']; ?>" data-id="<?php echo $obj['Utilisateur']['id']; ?>"><?php echo $obj['Utilisateur']['NOMLONG']; ?></li>
              <?php endforeach; ?>
            </ul>
            <div style='text-align:center;margin-top:20px !important;'>
            <button  type="button" class="btn btn-sm btn-default selectalluser">Tout sélectionner</button>&nbsp;<button  type="button" class="btn btn-sm btn-default unselectalluser">Tout désélectionner</button>
            </div>
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdcontributeurs">Fermer</button><!--<button type="submit" class="btn btn-sm btn-default" id="savemodaladdcontributeurs">Fermer</button>-->
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
    
    var listuser = [];

    $("#Counter").text(listuser.length + " éléments sélectionnés");
        
    $('#modaladdcontributeurs').on('show.bs.modal', function (e) {
        //récupération desz contributeurs à partir du champs caché
        var contributeurs = $("#ActionCONTRIBUTEURS").val();
        //convertir en array
        if(contributeurs) { listuser = contributeurs.split(",");console.log($(".list-user-item").attr("data-id")); }
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
                $("#ActionCONTRIBUTEURS").val(listuser.sort().join());
            }
            
        });
        $("#Counter").text(listuser.length + " éléments sélectionnés");
    });
    
    $('#modaladdcontributeurs').on('hidden.bs.modal', function (e) {
       $("#NBCONTRIBUTEURS").text(listuser.length);
       var list = $('#listuser');
       var users = [];
       $( ".list-user-item" ).each(function( index ) {
          if($(this).hasClass('active')){
            users.push($(this).text());
          }
      });
       $("#btnCONTRIBUTEURS").attr('data-title',users.join(';'));
       $("#btnCONTRIBUTEURS").attr('data-original-title',users.join(';'));
    });

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

    $(document).on("click",".list-user-item",function() {
        if($(this).hasClass('active')){
          listuser.splice($.inArray($(this).attr("data-id"), listuser),1);
          $(this).removeClass('active');
        } else {
          listuser.push($(this).attr("data-id"));
          $(this).addClass('active');
        }
        $("#ActionCONTRIBUTEURS").val(listuser.sort().join());
        $("#Counter").text(listuser.length + " éléments sélectionnés");
    });

    $(document).on("click",".selectalluser",function() {
        $( ".list-user-item" ).each(function( index ) {
          if($(this).is(':visible') && !$(this).hasClass('active')){
            listuser.push($(this).attr("data-id"));
            $(this).addClass('active');
          }
        });
        $("#ActionCONTRIBUTEURS").val(listuser.sort().join());
        $("#Counter").text(listuser.length + " éléments sélectionnés");
    });

    $(document).on("click",".unselectalluser",function() {
        listuser = [];
        $( ".list-user-item" ).each(function( index ) {
          $(this).removeClass('active');
          $("#ActionCONTRIBUTEURS").val(listuser.sort().join());
          $("#Counter").text(listuser.length + " élément sélectionné");
        });
    });  
    $(document).on('click','#closemodaladdcontributeurs',function(e){
        $('#modaladdcontributeurs').modal('toggle');
    });    
    
    $(document).on('click','#savemodaladdcontributeurs',function(){
        $('#modaladdcontributeurs').modal('toggle');
    });
});
</script>