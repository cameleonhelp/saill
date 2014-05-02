<?php $modaltitle = "Dupliquer pour la semaine :"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalduplicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
        </div>
        <div class="modal-body">
            <div class="block-content">
                <?php echo $this->Form->create('Activitesreelle',array('action'=>'autoduplicate','id'=>'formValidate_date','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
                    <label class="col-md-3" for="ActivitesreellesDATE">Date : </label>
                    <div class="col-md-8" style="margin-left:14px;">
                        <div class="input-group">
                        <?php $today = new dateTime(); $today->add(new DateInterval('P7D'));?>
                        <?php echo $this->Form->input('DATE',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'required'=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActivitesreellesDATE"><span class="glyphicons circle_remove grey"></span></span>
                        <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActivitesreellesDATE"><span class="glyphicons calendar"></span></span>
                        </div>                
                    </div>
                </div> 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" id="closemodalduplicate">Annuler</button><button type="button" class="btn btn-sm btn-default showoverlay" id="savemodalduplicate">Dupliquer</button>
        </div>
        <?php echo $this->Form->end(); ?> 
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodalduplicate',function(e){
        $('#modalduplicate').modal('toggle');
    }); 
    
    $(document).on('click','.retweet',function(e){
        var arid = $(this).parents('a').attr('data-activitesreelleid');
        $('#modalduplicate #ActivitesreelleId').val(arid);
    });   
        
    $(document).on('click','#savemodalduplicate',function(e){
        var idar =  $('#modalduplicate #ActivitesreelleId').val();
        var d =  $('#modalduplicate #ActivitesreelleDATE').val().split('/');
        var date = d[2]+"-"+d[1]+"-"+d[0];
        var url = $('#formValidate_date').attr('action')+'/'+idar+'/'+date;
        $('#formValidate_date').attr('action',url).submit();
    });   
});
</script>          