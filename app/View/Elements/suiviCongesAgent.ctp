<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Type absences</th>
            <th width="40px">Jan.</th>
            <th width="40px">Fév.</th>
            <th width="40px">Mars</th>
            <th width="40px">Avril</th>
            <th width="40px">Mai</th>
            <th width="40px">Juin</th>
            <th width="40px">Juil.</th>
            <th width="40px">Août</th>
            <th width="40px">Sept.</th>
            <th width="40px">Oct.</th>
            <th width="40px">Nov.</th>
            <th width="40px">Déc.</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
         <tr>
            <th>Congés</th>
                 <?php $totalrowC = 0; ?>
                 <?php for ($i=1;$i<13;$i++) :?>
                 <?php $mois = $i<10 ? '0'.$i : $i; ?>
                 <td style='text-align: right;' class='<?php echo $mois; ?>'><?php echo $tabconges[$mois]; ?></td>
                 <?php $totalrowC += $tabconges[$mois]; ?>
                 <?php endfor; ?>           
            <td style='text-align: right;' class='13' id='totConge'><?php echo $totalrowC; ?></td>
        </tr>
        <tr>
            <th>RQ</th>
                 <?php $totalrowRQ = 0; ?>            
                 <?php for ($i=1;$i<13;$i++) :?>
                 <?php $mois = $i<10 ? '0'.$i : $i; ?>
                 <td style='text-align: right;' class='<?php echo $mois; ?>'><?php echo $tabRQ[$mois]; ?></td>
                 <?php $totalrowRQ += $tabRQ[$mois]; ?>
                 <?php endfor; ?> 
            <td style='text-align: right;' class='13' id='totRQ'><?php echo $totalrowRQ; ?></td>
        </tr>                            
        <tr>
            <th>VT</th>
                 <?php $totalrowVT = 0; ?>               
                 <?php for ($i=1;$i<13;$i++) :?>
                 <?php $mois = $i<10 ? '0'.$i : $i; ?>
                 <td style='text-align: right;' class='<?php echo $mois; ?>'><?php echo $tabVT[$mois]; ?></td>
                 <?php $totalrowVT += $tabVT[$mois]; ?>                 
                 <?php endfor; ?> 
            <td style='text-align: right;' class='13' id='totVT'><?php echo $totalrowVT; ?></td>
        </tr>                            
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td id='total01' style='text-align: right;'></td>
            <td id='total02' style='text-align: right;'></td>
            <td id='total03' style='text-align: right;'></td>
            <td id='total04' style='text-align: right;'></td>
            <td id='total05' style='text-align: right;'></td>
            <td id='total06' style='text-align: right;'></td>
            <td id='total07' style='text-align: right;'></td>
            <td id='total08' style='text-align: right;'></td>
            <td id='total09' style='text-align: right;'></td>
            <td id='total10' style='text-align: right;'></td>
            <td id='total11' style='text-align: right;'></td>
            <td id='total12' style='text-align: right;'></td>
            <td id='total' style='text-align: right;'></td>
        </tr>                             
    </tfoot>
</table>
<script>
    function sumOfColumns(mois) {
        var tot = 0;
        $("."+mois).each(function() {
          tot += parseFloat($(this).html());
        });
        return tot+" j";
     }
     
     $(document).ready(function () {
         $("#total01").html(sumOfColumns('01'));
         $("#total02").html(sumOfColumns('02'));
         $("#total03").html(sumOfColumns('03'));
         $("#total04").html(sumOfColumns('04'));
         $("#total05").html(sumOfColumns('05'));
         $("#total06").html(sumOfColumns('06'));
         $("#total07").html(sumOfColumns('07'));
         $("#total08").html(sumOfColumns('08'));
         $("#total09").html(sumOfColumns('09'));
         $("#total10").html(sumOfColumns('10'));
         $("#total11").html(sumOfColumns('11'));
         $("#total12").html(sumOfColumns('12'));
         $("#total").html(sumOfColumns('13'));
     });
</script>