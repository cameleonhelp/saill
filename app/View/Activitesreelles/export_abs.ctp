<STYLE type="text/css">
    tr{
        height:16px;
    }
	.tableTd,.footer {
		border: solid whitesmoke 1px; 
                background-color: #EEEEEE;
                color: #078AFA;
                text-align: center;
	}
	.tableTdContent{
            border: solid whitesmoke 1px; 
            color:black;
	}
	#titles{
		font-weight: bolder;
	}
        .tableTdFerie{
            border: solid whitesmoke 1px; 
            background-color: #6E267B !important;
            color: whitesmoke;
        }
        .tableTdWE{
            border: solid whitesmoke 1px; 
            background-color: #CB0044 !important;
            color: whitesmoke;
        }
        .tableTdAbsent{
            border: solid whitesmoke 1px; 
            background-color: #AEA79F;
            color:AEA79F;
        }
        .tableTdTemp{
            border: solid whitesmoke 1px; 
            /*background-color: #DEDEDE;*/
            background:white;
            mso-pattern:#D8D8D8 reverse-diag-stripe;
            content: "?";
        }
</STYLE>
<table>
        <tr id="titles"><td class="tableTd" colspan='<?php echo (($ardate[2]-1)*2)+1; ?>' width="<?php echo (($ardate[2]-1)*5)+50; ?>px"><?php echo strMonth($ardate[0]).' '.$ardate[1]; ?></td></tr>
        <tr id="titles">
            <td class="tableTd" rowspan="2">Nom</td>
            <?php for ($i=1;$i<$ardate[2];$i++): 
                    $nbday = date("N", mktime(0, 0, 0, $ardate[0], $i, $ardate[1]))-1;
                    $day = $i<10 ? '0'.$i : $i;
                    $date=new DateTime($ardate[1].'-'.$ardate[0].'-'.$day);
                    $ferie = isFerie($date) ? 'tableTdFerie' : '';             
                    $weekend = $date->format('N');
                    $week = $weekend >5 ? "tableTdWE" : "";
                    $strday = array("Lu","Ma","Me","Je","Ve","Sa","Di");
                    $class = "tableTd";
                    if($week && !$ferie):
                        $class =  "tableTdWE";
                    elseif ($ferie):
                        $class =  "tableTdFerie";
                    endif;
                ?>
                <td class="<?php echo $class; ?>" colspan='2' width="5px"><?php echo $strday[$nbday]; ?></td>
            <?php endfor; ?>
        </tr>
        <tr id="titles">
            <?php for ($i=1;$i<$ardate[2];$i++): 
                    $day = $i<10 ? '0'.$i : $i;
                    $date=new DateTime($ardate[1].'-'.$ardate[0].'-'.$day);
                    $ferie = isFerie($date);             
                    $weekend = $date->format('N');
                    $week = $weekend > 5;
                    $class = "tableTd";
                    if($week && !$ferie):
                        $class =  "tableTdWE";
                    elseif ($ferie):
                        $class =  "tableTdFerie";
                    endif;
                ?>
                <td class="<?php echo $class; ?>" colspan='2' width="5px"><?php echo $day; ?></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($utilisateurs as $utilisateur) : ?>
        <tr>
            <td class='tableTdContent' style='white-space: nowrap;'><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $utilisateur['Utilisateur']['NOMLONG']); ?></td>
            <?php
            $debutactif = CIntDateDeb($utilisateur['Utilisateur']['DATEDEBUTACTIF']); 
            $debutinactif = CIntDateFin($utilisateur['Utilisateur']['FINMISSION']);
            for ($i=1; $i<$ardate[2]; $i++):
                $absences = listIndispo($indisponibilites); 
                $day = $i<10 ? '0'.$i : $i;
                $date=new DateTime($ardate[1].'-'.$ardate[0].'-'.$day);
                $ferie = isFerie($date) ? ' tableTdFerie ' : '';             
                $weekend = $date->format('N');
                $week = $weekend >5 ? " tableTdWE " : "";
                $class = "tableTdContent";
                if($week && !$ferie):
                    $class =  "tableTdWE";
                elseif ($ferie):
                    $class =  "tableTdFerie";
                endif;                
                if($debutactif > CIntDate($date->format('d/m/Y')) || $debutinactif < CIntDate($date->format('d/m/Y'))):
                    $class = $class == "tableTdContent" ? 'tableTdAbsent' : $class;
                    echo "<td class='".$class."' width='5px'></td><td class='".$class."'></td>";
                else :
                    $class1 = $class;
                    $class2 = $class;
                    if(is_date_utilisateur_in_array($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences)):
                        $result = nb_periode($date->format('Y-m-d'),$utilisateur['Utilisateur']['id'],$absences);
                        if (substr($result['nb'],2,1)=='0') {
                            $classIndispo1 = $result['tmp'] ? 'tableTdTemp' : 'tableTdAbsent';
                            $classIndispo2 = $result['tmp'] ? 'tableTdTemp' : 'tableTdAbsent';
                        }                
                        if (substr($result['nb'],2,1)=='5' && $result['periode']) {
                            $classIndispo1 = $result['tmp'] ? 'tableTdTemp' : 'tableTdAbsent';
                            $classIndispo2 = '';
                        }
                        if (substr($result['nb'],2,1)=='5' && !($result['periode'])) {
                            $classIndispo1 = '';
                            $classIndispo2 = $result['tmp'] ? 'tableTdTemp' : 'tableTdAbsent';
                        }            
                        $class1 = $classIndispo1 != "" ? $classIndispo1 : $class1;
                        $class2 = $classIndispo2 != "" ? $classIndispo2 : $class2;
                        echo "<td class='".$class1."' width='5px'></td><td class='".$class2."'></td>";
                    else:
                        echo "<td class='".$class1."' width='5px'></td><td class='".$class2."'></td>";
                    endif; 
                endif;
            endfor;
            ?>
        </tr>
        <?php endforeach; ?>
</table>