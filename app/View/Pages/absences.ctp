<?php $this->set('title_for_layout','Calendrier des absences'); ?>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <?php
            $maxday = date('t')+1;
            /*$maxday = 32;*/
            $month = date('m');
            $year = date('Y');
            $strMonth = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            ?>
            <tr>
                <th colspan="<?php echo ($maxday*2)+1; ?>" class="text-center"><div class="pull-left"><i class="icon-arrow-left"></i></div><?php echo $strMonth[$month]." ".$year; ?><div class="pull-right"><i class="icon-arrow-right"></i></div></th>
            </tr>
            <tr>
            <th class="nopadding nomargin nowrap" style="vertical-align: middle;" rowspan="2">Login</th>
            <?php 
            for($i=1;$i<$maxday;$i++) {
                $nbday = date("N", mktime(0, 0, 0, $month, $i, $year))-1;
                $strday = array("Lu","Ma","Me","Je","Ve","Sa","Di");
                echo "<th colspan='2' class='nopadding nomargin nowrap'>$strday[$nbday]</th>";
            }
            ?>
            </tr>
            <tr>
            <?php 
            for($i=1;$i<$maxday;$i++) {
                $day = $i<10 ? '0'.$i : $i;
                echo "<th colspan='2'  class='nopadding nomargin nowrap'>$day</th>";
            }
            ?>
            </tr>
        
        </thead>
        <tbody>
            <?php for($j=0;$j<5;$j++) { ?>
            <tr>
            <td class="nopadding nomargin nowrap"><div rel="tooltip" data-title="NOM Prénom">IDENT AGENT</div></td>
            <?php for($i=1;$i<$maxday;$i++) {
                $weekend = date("N", mktime(0, 0, 0, $month, $i, $year));
                $class = $weekend >5 ? 'class="absday week nopadding nomargin nowrap"' : 'class="absday nopadding nomargin nowrap"';
                echo "<td ".$class.">&nbsp;</td><td ".$class.">&nbsp;</td>";
            }
            ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>