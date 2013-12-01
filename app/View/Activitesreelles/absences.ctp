<?php $this->set('title_for_layout','Calendrier des absences'); ?>
<div class="marginright10">
<table class="table table-bordered table-striped table-hover" id="capture">
        <thead>
            <?php
            $maxday = isset($this->data['Activitesreelle']['month']) ? date('t',strtotime($this->data['Activitesreelle']['month']))+1 : date('t')+1;
            $month = isset($this->data['Activitesreelle']['month']) ? date('m',strtotime($this->data['Activitesreelle']['month'])) :date('m');
            $year = isset($this->data['Activitesreelle']['month']) ? date('Y',strtotime($this->data['Activitesreelle']['month'])) : date('Y');
            $pass = isset($this->data['Activitesreelle']['pass']) ? $this->data['Activitesreelle']['pass'] : '0';
            $strMonth = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            ?>
            <?php echo $this->Form->create('Activitesreelle',array('action' => 'absences','style'=>'display:none;','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <tr>
                    <th colspan="<?php echo ($maxday*2)+1; ?>" class="text-center">
                        <div class="btn-group pull-left">
                            <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                              Filtre utilisateurs
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li style="text-align:left;"><?php echo $this->Html->link('Tous', "#",array('class'=>'showoverlay','id'=>"all")); ?></li>
                                <li style="text-align:left;"><?php echo $this->Html->link('Mon équipe', "#",array('class'=>'showoverlay','id'=>"team")); ?></li>
                            </ul>
                        </div>
                        <?php echo $this->Form->button('<span class="glyphicons left_arrow" data-container="body" rel="tooltip" data-title="Mois précédent"></span>', array('id'=>"previousMonth",'type'=>'button','class' => 'btn  btn-sm btn-default','style'=>'margin-right:75px;')); ?>
                            <?php echo $strMonth[$month]." ".$year; ?>
                        <?php echo $this->Form->button('<span class="glyphicons right_arrow" data-container="body" rel="tooltip" data-title="Mois suivant"></span>', array('id'=>"nextMonth",'type'=>'button','class' => 'btn btn-sm btn-default','style'=>'margin-left:75px;')); ?>
                        <?php echo $this->Form->button('<span class="glyphicons clock" data-container="body" rel="tooltip" data-title="Mois courant"></span>', array('id'=>"today",'type'=>'button','class' => 'btn  btn-sm btn-default pull-right')); ?>
                        <?php echo $this->Form->button('<span class="glyphicons camera" data-container="body" rel="tooltip" data-title="Enregistrez au format PNG"></span>', array('id'=>"canvas",'type'=>'button','class' => 'btn  btn-sm btn-default pull-right')); ?>
                    </th>
                </tr>
            <?php $day = new DateTime(); $date = isset($this->data['Activitesreelle']['month']) ? $this->data['Activitesreelle']['month'] : $day->format('Y-m-d'); ?>
            <?php echo $this->Form->input('month',array('type'=>'hidden','value'=>$date)); ?>
            <?php echo $this->Form->input('pass',array('type'=>'hidden','value'=>$pass)); ?>
            <?php echo $this->Form->end(); ?>
            <tr>
            <th class="nowrap" style="vertical-align: middle;" rowspan="2">Nom</th>
            <?php 
            for($i=1;$i<$maxday;$i++) {
                $nbday = date("N", mktime(0, 0, 0, $month, $i, $year))-1;
                $day = $i<10 ? '0'.$i : $i;                
                $date= new DateTime($year.'-'.$month.'-'.$day);
                $classferie = isFerie($date) ? ' ferie' : '';                
                $strday = array("Lu","Ma","Me","Je","Ve","Sa","Di");
                $weekend = $date->format('N');
                $class = $weekend >5 ? "class='absday week text-center nowrap" : "class='absday text-center nowrap";
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
                $class = $weekend >5 ? "class='absday week nowrap text-center" : "class='absday nowrap text-center";
                echo "<th colspan='2' ".$class.$classferie."'>".$day."</th>";
            }
            ?>
            </tr>
        
        </thead>
        <tbody>
            <?php foreach($utilisateurs as $utilisateur) : ?>
            <tr class="thin-height">
                <td class="nowrap" style="max-width:120px !important;width:120px !important;min-width:120px !important;"><div  data-container="body" rel="tooltip" data-title="<?php echo $utilisateur['Utilisateur']['NOMLONG']." (".$utilisateur['Utilisateur']['username'].")"; ?>"><?php echo substr($utilisateur['Utilisateur']['PRENOM'],0,1).". ".$utilisateur['Utilisateur']['NOM']; ?></div></td>
            <?php
            $debutactif = CIntDateDeb($utilisateur['Utilisateur']['DATEDEBUTACTIF']); 
            $debutinactif = CIntDateFin($utilisateur['Utilisateur']['FINMISSION']);
            for ($i=1; $i<$maxday; $i++):
                $absences = listIndispo($indisponibilites);                
                $day = $i<10 ? '0'.$i : $i;
                $date=new DateTime($year.'-'.$month.'-'.$day);
                $weekend = $date->format('N');
                $classweek = $weekend >5 ?  ' week': '';              
                $class = "class='absday nowrap";
                $classferie = isFerie($date) ? ' ferie' : '';
                if($debutactif > CIntDate($date->format('d/m/Y')) || $debutinactif < CIntDate($date->format('d/m/Y'))):
                    $classIndispo = ' indispo';
                    echo "<td ".$class.$classIndispo.$classweek.$classferie."' style='line-height: 4px;'></td><td ".$class.$classIndispo.$classweek.$classferie."'></td>";
                else :
                    if(is_date_utilisateur_in_array($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences)):
                        $result = nb_periode($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences);
                        if (substr($result['nb'],2,1)=='0') {
                            $classIndispo1 = $result['tmp'] ? ' tmpindispo' : ' indispo';
                            $classIndispo2 = $result['tmp'] ? ' tmpindispo' : ' indispo';
                        }                
                        if (substr($result['nb'],2,1)=='5' && $result['periode']) {
                            $classIndispo1 = $result['tmp'] ? ' tmpindispo' : ' indispo';
                            $classIndispo2 = '';
                        }
                        if (substr($result['nb'],2,1)=='5' && !($result['periode'])) {
                            $classIndispo1 = '';
                            $classIndispo2 = $result['tmp'] ? ' tmpindispo' : ' indispo';
                        }            
                        echo "<td ".$class.$classweek.$classferie.$classIndispo1."' style='line-height: 4px;'></td><td ".$class.$classweek.$classferie.$classIndispo2."'></td>";
                    else:
                        echo "<td ".$class.$classweek.$classferie."' style='line-height: 4px;'></td><td ".$class.$classweek.$classferie."'></td>";               
                    endif; 
                endif;
            endfor;
            ?>
            </tr>
            <?php 
            endforeach; ?>
        </tbody>
    </table>
    </div>
<script>
     $(document).ready(function () {
         $("#previousMonth").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();               
             var date = moment($('#ActivitesreelleMonth').val()).subtract('M', 1);
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         });
         $("#nextMonth").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                 
             var date = moment($('#ActivitesreelleMonth').val()).add('M', 1);
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         }); 
         $("#today").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                
             var date = moment();
             $('#ActivitesreelleMonth').val(date.format('YYYY-MM-DD'));
             $('#ActivitesreelleAbsencesForm').submit();
         });  
         $("#all").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                
             var date = moment();
             $('#ActivitesreellePass').val('0');
             $('#ActivitesreelleAbsencesForm').submit();
         });   
         $("#team").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                
             var date = moment();
             $('#ActivitesreellePass').val('1');
             $('#ActivitesreelleAbsencesForm').submit();
         });          
         $("#canvas").on('click',function(e){
            html2canvas($("#capture"),{
                useCORS:true,
                onrendered: function (canvas) {
                    var oCanvas = canvas.toDataURL('image/png');
                    Canvas2Image.saveAsPNG(canvas);
                }
            });
         });
     });
</script>
