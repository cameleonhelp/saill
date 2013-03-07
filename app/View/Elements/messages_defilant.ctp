<?php $activeMessages = $this->requestAction('messages/activeMessage'); ?>
<?php if ($activeMessages) { 
    $firstmsg = '';
    $othersmessages = '';
    foreach ($activeMessages as $activeMessage) {
            $firstmsg .=  "&nbsp;<i class='icon-hand-right  icon-white'></i>&nbsp;".$activeMessage['Message']['LIBELLE'];            
            $othersmessages .= "&nbsp;<i class='icon-hand-right  icon-white'></i>&nbsp;".$activeMessage['Message']['LIBELLE'];
    }
    echo "<div class='jscroller2_left jscroller2_speed-20 jscroller2_mousemove jscroller2_ignoreleave jscroller2_dynamic clearfix'>".$firstmsg."</div><div class='jscroller2_left_endless jscroller2_mousemove clearfix'>".$othersmessages.'</div>';
} else {
    echo "<div class='jscroller2_left jscroller2_speed-20 jscroller2_mousemove jscroller2_ignoreleave jscroller2_dynamic clearfix'><i class='icon-hand-right  icon-white'></i>&nbsp;Pas de message disponible pour le moment...</div>";            
}
?>