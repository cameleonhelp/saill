<div class="">
<div class="logistique form">
<?php echo $this->Form->create('Rapport',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-4 required" for="RapportSectionId">Section : </label>
        <div class="col-md-4">
                <?php echo $this->Form->select('section_id',$sections,array('data-rule-required'=>'true','class'=>"form-control",'data-msg-required'=>"La section est obligatoire",'empty' => 'Choisir une section')); ?>
        </div>
    </div>
    <div style="clear:both;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>   
      </div>
    </div>  
    </div> 
<?php echo $this->Form->end(); ?>
</div>
<?php if (isset($agents)): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'agents actif par site</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table1">
    <thead>
        <tr>
        <th>Section</th>
        <th>Site</th>
        <th>Nombre agents</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($agents as $result): ?>
        <tr>
            <td><?php echo $result['sections']['NOM']; ?></td>
            <td><?php echo $result['sites']['NOM']; ?></td>
            <td style="text-align: center" class="nbagent"><?php echo $result[0]['NBAGENT']; ?></td>
        </tr>           
        <?php endforeach; ?>
    </tbody>  
    <tfoot>
	<tr>
            <td colspan="2" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalagent" style="text-align:center;"></td>
	</tr> 
    </tfoot>    
</table>
<?php elseif (isset($agents) && count($agents)==0): ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
<br/>
<?php if (isset($materiels) && count($materiels)>0): ?>
<div style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre de matériel par type et état</div><br>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax table2">
    <thead>
        <tr>
        <th>Section</th>
        <th>Matériel</th>
        <th>Etat</th>
        <th>Nombre de matériel</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($materiels as $result): ?>
        <tr>
            <td><?php echo $result['sections']['NOM']; ?></td>
            <td><?php echo $result['typemateriels']['NOM']; ?></td>
            <td><?php echo ucfirst_utf8($result['materielinformatiques']['ETAT']); ?></td>
            <td style="text-align: center" class="nbmat"><?php echo $result[0]['NBPC']; ?></td>
        </tr>           
        <?php endforeach; ?>
    </tbody>     
    <tfoot>
	<tr>
            <td colspan="3" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalmat" style="text-align:center;"></td>
	</tr> 
    </tfoot>      
</table>
<?php elseif (isset($materiels) && count($materiels)==0): ?>
<div class="bs-callout bs-callout-warning"><b>Aucun résultat pour ce rapport, modifier les paramètres de recherche ...</b></div>
<?php endif; ?>
</div>
<script>
$(document).ready(function (){ 
    function sumOfColumns(id) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2);
     }   
    $(".table1").tablesorter({
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : false,    
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#totalagent").html(newSumOfColumns('tr:not(.filtered) > td.nbagent',''));
    });  
    
    $(".table2").tablesorter({
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : false,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    }).bind('filterEnd',function(e,t){
        $("#totalmat").html(newSumOfColumns('tr:not(.filtered) > td.nbmat',''));
    });   
        
    function newSumOfColumns(id,symbole) {
        var tot = 0;
        $(id).each(function() {
          value = $(this).html()=='' ? 0: $(this).html();
          tot += parseFloat(value);
        });
        return parseFloat(tot).toFixed(0)+" "+symbole;
     };
        
    $("#totalagent").html(sumOfColumns('nbagent'));
    $("#totalmat").html(sumOfColumns('nbmat'));
});
</script>