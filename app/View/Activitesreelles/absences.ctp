<?php $this->set('title_for_layout','Calendrier des absences'); ?>
<table class="table table-bordered table-striped table-hover">
        <thead>
            <?php
            $maxday = isset($this->data['Activitesreelle']['month']) ? date('t',strtotime($this->data['Activitesreelle']['month']))+1 : date('t')+1;
            $month = isset($this->data['Activitesreelle']['month']) ? date('m',strtotime($this->data['Activitesreelle']['month'])) :date('m');
            $year = isset($this->data['Activitesreelle']['month']) ? date('Y',strtotime($this->data['Activitesreelle']['month'])) : date('Y');
            $strMonth = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            ?>
            <?php echo $this->Form->create('Activitesreelle',array('action' => 'absences','style'=>'display:none;','inputDefaults' => array('label'=>false,'div' => false))); ?>
                <tr>
                    <th colspan="<?php echo ($maxday*2)+1; ?>" class="text-center">
                        <?php echo $this->Form->button('<i class="icon-arrow-left""></i>', array('id'=>"previousMonth",'type'=>'button','class' => 'btn','style'=>'margin-right:75px;')); ?>
                            <?php echo $strMonth[$month]." ".$year; ?>
                        <?php echo $this->Form->button('<i class="icon-arrow-right"></i>', array('id'=>"nextMonth",'type'=>'button','class' => 'btn','style'=>'margin-left:75px;')); ?>
                        <?php echo $this->Form->button('<i class="icon-time"></i>', array('id'=>"today",'type'=>'button','class' => 'btn pull-right')); ?>
                    </th>
                </tr>
            <?php $day = new DateTime(); $date = isset($this->data['Activitesreelle']['month']) ? $this->data['Activitesreelle']['month'] : $day->format('Y-m-d'); ?>
            <?php echo $this->Form->input('month',array('type'=>'hidden','value'=>$date)); ?>
            <?php echo $this->Form->end(); ?>
            <tr>
            <th class="nopadding nomargin nowrap" style="vertical-align: middle;" rowspan="2">Login</th>
            <?php 
            for($i=1;$i<$maxday;$i++) {
                $nbday = date("N", mktime(0, 0, 0, $month, $i, $year))-1;
                $day = $i<10 ? '0'.$i : $i;                
                $date= new DateTime($year.'-'.$month.'-'.$day);
                $classferie = isFerie($date) ? ' ferie' : '';                
                $strday = array("Lu","Ma","Me","Je","Ve","Sa","Di");
                $weekend = $date->format('N');
                $class = $weekend >5 ? "class='absday week nopadding nomargin nowrap" : "class='absday nopadding nomargin nowrap";
                echo "<th colspan='2' ".$class.$classferie."'>".$strday[$nbday]."</th>";
            }
            ?>
            </tr>
            <tr>
            <?php 
            for($i=1;$i<$maxday;$i++) {
                $day = $i<10 ? '0'.$i : $i;
                $date=new DateTime($year.'-'.$month.'-'.$day);
                $classferie = isFerie($date) ? ' ferie' : '';
                $weekend = $date->format('N');
                $class = $weekend >5 ? "class='absday week nopadding nomargin nowrap" : "class='absday nopadding nomargin nowrap";
                echo "<th colspan='2' ".$class.$classferie."'>".$day."</th>";
            }
            ?>
            </tr>
        
        </thead>
        <tbody>
            <?php foreach($utilisateurs as $utilisateur) : ?>
            <tr>
                <td class="nopadding nomargin nowrap"><div rel="tooltip" data-title="<?php echo $utilisateur['Utilisateur']['NOMLONG']." (".$utilisateur['Utilisateur']['username'].")"; ?>"><?php echo substr($utilisateur['Utilisateur']['PRENOM'],0,1).". ".substr($utilisateur['Utilisateur']['NOM'],0,7).'...'; ?></div></td>
            <?php
            for ($i=1; $i<$maxday; $i++):
                $absences = listIndispo($indisponibilites);                
                $day = $i<10 ? '0'.$i : $i;
                $date=new DateTime($year.'-'.$month.'-'.$day);
                $weekend = $date->format('N');
                $classweek = $weekend >5 ?  ' week': '';              
                $class = "class='absday nopadding nomargin nowrap";
                if(is_date_utilisateur_in_array($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences)):
                    $result = nb_periode($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences);
                    if (substr($result['nb'],2,1)=='0') {
                        $classIndispo1 = ' indispo';
                        $classIndispo2 = ' indispo';
                    }
                    if (substr($result['nb'],2,1)=='5' && $result['periode']) {
                        $classIndispo1 = ' indispo';
                        $classIndispo2 = '';
                    }
                    if (substr($result['nb'],2,1)=='5' && !($result['periode'])) {
                        $classIndispo1 = '';
                        $classIndispo2 = ' indispo';
                    }            
                    $classferie = isFerie($date) ? ' ferie' : '';
                    echo "<td ".$class.$classweek.$classferie.$classIndispo1."'></td><td ".$class.$classweek.$classferie.$classIndispo2."'></td>";
                else:
                    $classferie = isFerie($date) ? ' ferie' : '';
                    echo "<td ".$class.$classweek.$classferie."'></td><td ".$class.$classweek.$classferie."'></td>";               
                endif; 
            endfor;
            ?>
            </tr>
            <?php 
            endforeach; ?>
        </tbody>
    </table>
<script>
     $(document).ready(function () {
         $("#previousMonth").on('click', function(e){
             e.preventDefault();
             var date = moment($('#ActivitesreelleMonth').val()).subtract('M', 1);
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         });
         $("#nextMonth").on('click', function(e){
             e.preventDefault();
             var date = moment($('#ActivitesreelleMonth').val()).add('M', 1);
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         }); 
         $("#today").on('click', function(e){
             e.preventDefault();
             var date = moment();
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         });          
     });
</script>
