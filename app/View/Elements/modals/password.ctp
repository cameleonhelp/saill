<?php $modaltitle = "Modification de votre mot de passe"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <div id="msg-info" class="form-group" style="height:40px; margin-top:-30px;margin-bottom:10px;">
                <div class="bs-callout bs-callout-info col-md-12 clearfix">Il est préférable de modifier votre mot de passe</div>
            </div>             
            <div id="msg-error" class="form-group" style="height:40px; margin-bottom:10px;">
                <div id="msg" class="alert alert-danger col-md-12 clearfix"></div>
            </div>               
            <!-- contenu de la fenêtre modale //-->
            <div style="clear:both;">
            <div class="form-group" style="height:32px;">
                <label class="col-md-4" for="PasswordNew">Mot de passe : </label>
                <div class="col-md-6">
                    <?php echo $this->Form->input('password_new',array('label'=>false,'type'=>'password','class'=>'form-control','style'=>'width:200px;margin-bottom:10px;','data-rule-minlength'=>'5','data-msg-minlength'=>"Le mot de passe doit avoir au moins 5 caractères",'placeholder'=>'Mot de passe')); ?>
                </div>
            </div>
            <div class="form-group" style="height:32px;">
                <label class="col-md-4" for="Password">Confirmation </label>
                <div class="col-md-6">                
                    <?php echo $this->Form->input('password_confirm',array('label'=>false,'type'=>'password','class'=>'form-control','style'=>'width:200px;','data-rule-equalto'=>'#PasswordNew','data-msg-equalto'=>"Les mots de passe ne sont pas identiques",'placeholder'=>'Confirmation du mot de passe','value'=>'')); ?>    
                </div>
            </div>   
            </div>
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalpassword">Annuler</button><button type="button" class="btn btn-sm btn-default" id="savemodalpassword">Enregistrer</button>
    </div>         
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
    $('#msg-error').hide();
  
    $(document).on('click','#closemodalpassword',function(e){
        $('#modalpassword').modal('toggle');
    });
    
    $(document).on('click','#savemodalpassword',function(e){
        var overlay = $('#overlay');        
        if($('#password_new').val().length > 4 && $('#password_confirm').val().length > 4){
            if($('#password_new').val() != '' && $('#password_confirm').val() != ''){
                if($('#password_new').val() == $('#password_confirm').val()){
                    //ajax pour sauvegarder le mot de passe
                    $.ajax({
                        type: "POST",       
                        url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'ajax_save_password')); ?>",
                        data: {password:$('#password_new').val()},  
                    }).done(function() {
                        overlay.show(); 
                        setTimeout(function(){ location.reload(); }, 20);
                    }).fail(function(event,request,settings) {
                        console.log('INIT-PASSWORD-ERROR');console.log(event);console.log(event.status);console.log(request);console.log(settings);console.log(ids);return true;
                    }).always(function() {
                        $('#modalpassword').modal('toggle');
                    });                     
                } else {
                    $('#msg-error').show().find('#msg').text('Les deux mots de passe ne sont pas identiques.');
                    $('#password_new').parents('.form-group').addClass("has-error");
                    $('#password_confirm').parents('.form-group').addClass("has-error");
                    setTimeout(function(){ jQuery(".has-error").removeClass("has-error"); }, 0);
                    e.preventDefault();
                }
            } else {
                    $('#msg-error').show().find('#msg').text('Le mot de passe ne doit pas être vide.');
                    if($('#password_new').val() != '') {$('#password_new').parents('.form-group').addClass("has-error");}
                    if($('#password_confirm').val() != '') {$('#password_confirm').parents('.form-group').addClass("has-error");}
                    setTimeout(function(){ jQuery(".has-error").removeClass("has-error"); }, 0);
                    e.preventDefault();
            }
        } else {
                $('#msg-error').show().find('#msg').text('Le mot de passe doit comporter au moins 5 caractères.');
                if($('#password_new').val().length < 5) {$('#password_new').parents('.form-group').addClass("has-error");}
                if($('#password_confirm').val().length < 5) {$('#password_confirm').parents('.form-group').addClass("has-error");}
                setTimeout(function(){ jQuery(".has-error").removeClass("has-error"); }, 0);
                e.preventDefault();
        }  
        return true;
    });   
});
</script>