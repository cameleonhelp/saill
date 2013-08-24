<?php 
function debutsem($year,$month,$day) {
    $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
    $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
    $datedeb      = date('d/m/Y', $premier_jour);
    return $datedeb;
}

function finsem($year,$month,$day) {
    $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
    $dernier_jour = mktime(0,0,0, $month,7-(!$num_day?7:$num_day)+$day,$year);
    $datedeb      = date('d/m/Y', $dernier_jour);
    return $datedeb;
}

function joursemaine($usdate){
    $jour = date('d', strtotime($usdate));
    return $jour;
}

    $date = isset($_POST['Actionreelle.DATE']) ? $_POST['Actionreelle.DATE'] : date('Y-m-d');
    $day = date('d',strtotime($date));
    $mois = date('m',strtotime($date));
    $annee = date('Y',strtotime($date));
    $debutsemaine = debutsem($annee,$mois,$day);
    $finsemaine = finsem($annee, $mois, $day);
?>
<div id="semaine">
<table cellpadding="0" cellspacing="0" class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" colspan="9"><div class="pull-left cursor" id="previous"><span class="glyphicons left_arrow"></span></div>Répartition de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span><div class="pull-right"><span class="glyphicons cursor right_arrow"  id="next"></span></div></th>
    </tr>
    <tr>
        <th rowspan="2">Activité</th>
        <th width='70px'>Lu.</th>
        <th width='70px'>Ma.</th>
        <th width='70px'>Me.</th>
        <th width='70px'>Je.</th>
        <th width='70px'>Ve.</th>
        <th class='week' width='70px'>Sa.</th>
        <th class='week' width='70px'>Di.</th>
        <th rowspan="2">Action</th>
    </tr>
    <tr>
        <th><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +0 day"); ?></th>
        <th><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +1 day"); ?></th>
        <th><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +2 days"); ?></th>
        <th><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +3 days"); ?></th>
        <th><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +4 days"); ?></th>
        <th class='week'><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +5 days"); ?></th>
        <th class='week'><?php echo joursemaine(strtotime(CUSDate($debutsemaine))." +6 days"); ?></th>
    </tr> 
    </thead>
    <tbody>
<?php echo $this->Form->create('Actionreelle',array('id'=>'formActionreelle','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <tr>
        <td><?php echo $this->data['Activite']['NOM']; ?></td>
        <td width='15px'><?php echo $this->Form->input('LU',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('MA',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('ME',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('JE',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('VE',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td class='week' width='15px'><?php echo $this->Form->input('SA',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td class='week' width='15px'><?php echo $this->Form->input('DI',array('style'=>"width:35px",'class'=>'text-right')); ?> j</td>
        <td style='text-align: center !important;'><?php echo $this->Form->button('Enregistrer l\'activité', array('class' => 'btn btn-inverse','type'=>'submit')); ?></td>
    </tr>
    <?php echo $this->Form->input('DATE',array('type'=>'hidden','value'=>isset($this->data['Activitereeelle']['DATE']) ? $this->data['Activitereeelle']['DATE'] : date('Y-m-d'))); ?>
    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('action_id',array('type'=>'hidden')); ?>
    <?php echo $this->Form->input('activite_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('id',array('type'=>'hidden')); ?> 
    </form>  
    </tbody>
</table>
</div>

<script>
$(document).ready(function () {    
   /** Navigation dans le tableau de la semaine de répartirion de la consommation réelle des actions **/  
   function addDate(date,day){
       var date = new Date(date);
       date.setDate(date.getDate()+day);
       var mois = (date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1);
       var jour = date.getDate() < 10 ? "0"+date.getDate() : date.getDate();
       return date.getFullYear()+"-"+mois+"-"+jour;
   }
   
   function CFRDate(date){
       var date = new Date(date);
       var mois = (date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1);
       var jour = date.getDate() < 10 ? "0"+date.getDate() : date.getDate();
       return jour+"/"+mois+"/"+date.getFullYear();
   }
   
   var curdate = $('#ActionreelleDATE').val();
   var curId = $('#ActionreelleId').val();
   
   $('#previous').on('click', function(e){
       e.preventDefault();
       curdate = addDate(curdate,-7);
       $('#ActionreelleDATE').val(curdate);
       dataString = $("#formActionreelle").serialize();
       
       $.ajax({
           type: "POST",
           url: 'http://localhost/cake230/Activitesreeelles/edit/'+curId,
           data: dataString,
           success: function(data) {alert('post avec succés');} ,
           error : function(req, status, error) {alert('post avec error\r\n'+req.statusText);}
       })
   });
   
   $('#next').on('click', function(e){
       e.preventDefault(); 
       curdate = addDate(curdate,7);   
       $('#ActionreelleDATE').val(curdate);       
       dataString = $("#formActionreelle").serialize();
       
       $.ajax({
           type: "POST",
           url: 'http://localhost/cake230/Activitesreeelles/edit/'+curId,
           data: dataString,
           success: function(data) {alert('post avec succés');} ,
           error : function(req, status, error) {alert('post avec error\r\n'+req.statusText);}
       })       
   });
});
</script>
