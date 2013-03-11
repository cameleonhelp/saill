<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'OSACT '.  htmlspecialchars($this->element('version')));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

                echo $this->Html->css('bootstrap');
                echo $this->Html->css('editable');  
                echo $this->Html->css('datepicker');                     
                echo $this->Html->css('bootstrap.sncf');
                echo $this->Html->css('select');
                echo $this->Html->css('glyphicons');
                echo $this->Html->css('jscroller2');                
                
                echo $this->Html->script('jquery');
                echo $this->Html->script('bootstrap');              
                echo $this->Html->script('editable'); 
                echo $this->Html->script('validate');                
                echo $this->Html->script('messages_fr'); 
                echo $this->Html->script('datepicker'); 
                echo $this->Html->script('select'); 
                echo $this->Html->script('tiny_mce/tiny_mce');
                echo $this->Html->script('jscroller2'); 
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<script type="text/javascript"> 
    tinyMCE.init({ 
   // General options
   language : "fr",
   mode : "textareas",
   //elements : textarea,
   forced_root_block : false,
   force_br_newlines : true,
   force_p_newlines : false,
   theme : "advanced",
   skin : "bootstrap",
   entity_encoding : "raw",
   plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
   // Theme options
   theme_advanced_buttons1 : "newdocument,|,undo,redo,|,formatselect,fontselect,fontsizeselect,|,bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull",
   theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,link,unlink,cleanup,code,|,forecolor,backcolor,|,print",
   theme_advanced_buttons3 : "",
   theme_advanced_buttons4 : "",
   theme_advanced_toolbar_location : "top",
   theme_advanced_toolbar_align : "left",
   theme_advanced_statusbar_location : "none",
   theme_advanced_resizing : false,
   height : "200",
   width : "100%"
    }); 
</script> 
    <div class="container" style="margin-top: 15px;">
        <div class="row" >
            <div class="span7">
            <span class="logo"></span>
            <?php echo $this->element('menu'); ?>
            <code class="span5"  style="margin-left: -22px;margin-bottom: 10px;display: block;">
                <div class="text-normal">Navigateurs compatibles :</div>
                <div class='text-center'><?php echo $this->Html->link($this->Html->image("firefox.png",array("height" => "24px","width" => "24px")),"http://www.mozilla.org/fr/firefox/new/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"Firefox<br/>Recommandé")) ?>
                <?php echo $this->Html->link($this->Html->image("ie.png",array("height" => "24px","width" => "24px")),"http://www.internetexplorer.fr",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"Internet Explorer")) ?>                
                </div>
                <div class="text-normal">Résolution recommandée :</div>
                <div class='text-center'><?php echo $this->Html->image("1280.png",array('rel'=>"tooltip",'data-title'=>"Résolution minimum<br />recommandée")); ?></div>
            </code>
            <code class="span5"  style="margin-left: -22px;margin-bottom: 10px;display: block;">
                <div class="text-normal">Réalisé à partir de :</div>
                <div class='text-center'><?php echo $this->Html->link($this->Html->image("cakephp.png",array("height" => "24px","width" => "24px")),"http://cakephp.org/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"CakePHP")) ?>
                <?php echo $this->Html->link($this->Html->image("bootstrap.png",array("height" => "24px","width" => "24px")),"http://twitter.github.com/bootstrap/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"BootStrap")) ?>                
                <?php echo $this->Html->link($this->Html->image("mySQL.png",array("height" => "24px","width" => "24px")),"http://www.mysql.fr/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"MYSQL")) ?>                                    
                <?php echo $this->Html->link($this->Html->image("jquery.png",array("height" => "24px","width" => "24px")),"http://www.jquery.com/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"JQuery")) ?>                                    
                <?php echo $this->Html->link($this->Html->image("tinymce.png",array("height" => "24px","width" => "24px")),"http://www.tinymce.com/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"TinyMCE")) ?>                                        
                </div>
            </code>            
            </div>
            <div class="span29">
                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                    <div class="navbar-text text-white">
                        <div id="scroller_container">
                            <?php echo $this->element('messages_defilant'); ?>
                        </div>
                    </div>
                    </div>
                </div>  
                <div class="navbar navbar-purple">
                    <div class="navbar-inner">
                    <div class="brand" ><?php echo $title_for_layout; ?></div>
                    </div>
                </div>
		<div id="content">
                        <div style="cursor:pointer;"><?php echo $this->Session->flash(); ?></div>
                        <div id="container_message" name="container_message" class="alert alert-error"><ol><li></li></ol></div>
			
			<?php echo $this->fetch('content'); ?>
		</div>
            </div>
        </div>
    </div>    
    <?php //$url = $this->Session->read('history'); debug($this->params->url); 
    //debug(env('SERVER_ADDR')); ?>
    <!--<div id="debugguer" style="background-color: #cccccc;">SQL Debug :
        <?php // echo $this->element('sql_dump'); ?>
    </div>//-->   

</body>
</html>
<script>
$.fn.editable.defaults.mode = 'inline';

$(document).ready(function () {
    /** Initialisation des durée des actions **/
    $('#ActionDUREEPREVUE').val()=='' ? $('#ActionLblDUREEPREVUE').text('0 jour') : $('#ActionLblDUREEPREVUE').text(($('#ActionDUREEPREVUE').val()/8)+' jours');
    $('#ActionDUREEREELLE').val()=='' ? $('#ActionLblDUREEREELLE').text('0 jour') : $('#ActionLblDUREEREELLE').text(($('#ActionDUREEREELLE').val()/8)+' jours');
    var avancement = $('#ActionAVANCEMENT').val() < 0 ? 0 : $('#ActionAVANCEMENT').val() > 100 ? 100 : $('#ActionAVANCEMENT').val();
    avancement = Math.round(avancement/10)*10;
    $('#ActionAVANCEMENT').val(avancement);
    $('#progressbar').attr('style',"width:"+avancement+"%;");
    /** Fermeture du message en cliquant dessus **/
    $('#flashMessage').on('click',function(){$(this).hide();});
    /** Application d'un style sur les select **/
    $('select').selectpicker({size:5,});
    /** Application d'un style sur les select **/
    $(".yesno").each( function() { $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non"); });
    $(".yesno").click(function() {
        $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non");
    });
    /** Messages error - info - warning - success **/
    $(".alert").alert()
    /** Cache la zone de message d'erreur pour le formulaire **/
    $("#container_message").hide();
    /** Tooltip **/
     if ($("[rel=tooltip]").length) {
     $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
     }   
    /** PopOver **/ 
    var isVisible = false;
    var clickedAway = false;
    if ($("[rel=popover]").length) {
        $("[rel=popover]").popover({placement:'bottom',trigger:'manual',html:true}).click(function(e) {
                $(this).popover('toggle');
                clickedAway = false
                isVisible = true
                e.preventDefault()
            });
    }  
    $('html').click(function(e) {
        if(isVisible & clickedAway)
        {
          $("[rel=popover]").popover('hide')
          isVisible = clickedAway = false
        }
        else
        {
          clickedAway = true
        }
    });
    /** DatePicker **/	        
    $(".date").datepicker({
         format: 'dd/mm/yyyy',
         weekStart: 1,
		 todayBtn: 'linked',
		 autoclose:true,
		 todayHighlight:true		 
    })
   $(".dateremove").click(function(){
           d = new Date;
           $(this).parent().datepicker('update', d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear());
           $(this).parent().children("input").val('');
	   $(this).parent().data('datepicker').date = null;
   }) 
   $(".datedefault").click(function(){
       d = new Date;
       $(this).parent().children("input").val('05/01/'+(d.getFullYear()+1));
       $(this).parent().datepicker('update', '05/01/'+(d.getFullYear()+1));
   }) 
   /** Editable **/
   $('#NOM').editable();
   /** Fermeture des autres popovers de icon-zoom-in **/
   //$(".icon-eye-open").on("click", function(e){
   //    $(this).parents('.table').nextUntil($(this),".popover").removeClass('in').hide();
   //});
   /** Connexion validation du formulaire **/
   var container = $('#container_message');
   $("#formValidate").submit(function() {
                        // update underlying textarea before submit validation
                        tinyMCE.triggerSave();
                }).validate({ignore: "",errorContainer: container,errorLabelContainer: $("ol", container),wrapper: 'li',meta: "validate",
    highlight: function(element) {
        $(element).closest('.control-group').addClass('error');
        },
    unhighlight: function(element) {
        $(element).closest('.control-group').removeClass('error');
        }
   });
   /** Check all **/
   $('.checkall').on('click',function (e) {
        $(this).parents('.table').find(':checkbox').prop('checked', this.checked);
   }); 
   /** Aide au calcul du Tarif TTC **/
   $('#calculer').on('click',function(e){
       e.preventDefault();
       var tjmHt = $("input[id=prixht]").val();
       var locaux = $("input[id=locaux]").val();
       var fraisdsit = $("input[id=fraisdsit]").val();
       var fraisdiv = $("input[id=fraisdiv]").val();
       var tjm_locaux =parseFloat(tjmHt) + parseFloat(locaux);
       var tjm_locaux_dsit = parseFloat(tjm_locaux)*parseFloat(fraisdsit);
       var totalBrut = parseFloat(tjm_locaux_dsit)*parseFloat(fraisdiv);
       totalBrut = !isNaN(totalBrut) ? totalBrut : 0;       
       $("input[id=total]").val(parseFloat(totalBrut.toFixed(2)));       
   });
   $('#UtiliseoutilOutilId').parent().on('click',function(e){
       e.preventDefault();     
   }); 
   $('#UtiliseoutilOutilId').on('change',function(){
       if (this.value != ''){
           $('#UtiliseoutilDossierpartageId').parent().children().children('button').addClass('disabled');
           $('#UtiliseoutilListediffusionId').parent().children().children('button').addClass('disabled');
       } else {
           $('#UtiliseoutilDossierpartageId').parent().children().children('button').removeClass('disabled');
           $('#UtiliseoutilListediffusionId').parent().children().children('button').removeClass('disabled');
       }
   });
   $('#UtiliseoutilDossierpartageId').parent().on('click',function(e){
       e.preventDefault();    
   }); 
   $('#UtiliseoutilDossierpartageId').on('change',function(){
       if (this.value != ''){
           $('#UtiliseoutilOutilId').parent().children().children('button').addClass('disabled');
           $('#UtiliseoutilListediffusionId').parent().children().children('button').addClass('disabled');
       } else {
           $('#UtiliseoutilOutilId').parent().children().children('button').removeClass('disabled');
           $('#UtiliseoutilListediffusionId').parent().children().children('button').removeClass('disabled');
       }
   });
   $('#UtiliseoutilListediffusionId').parent().on('click',function(e){
       e.preventDefault();     
   }); 
   $('#UtiliseoutilListediffusionId').on('change',function(){
       if (this.value != ''){
           $('#UtiliseoutilDossierpartageId').parent().children().children('button').addClass('disabled');
           $('#UtiliseoutilOutilId').parent().children().children('button').addClass('disabled');
       } else {
           $('#UtiliseoutilDossierpartageId').parent().children().children('button').removeClass('disabled');
           $('#UtiliseoutilOutilId').parent().children().children('button').removeClass('disabled');
       }
   }); 
   $('#DotationMaterielinformatiquesId').parent().on('click',function(e){
       e.preventDefault();     
   }); 
   $('#DotationMaterielinformatiquesId').on('change',function(){
       if (this.value != ''){
           $('#DotationTypematerielId').parent().children().children('button').addClass('disabled');
       } else {
           $('#DotationTypematerielId').parent().children().children('button').removeClass('disabled');
       }
   });  
   $('#DotationTypematerielId').parent().on('click',function(e){
       e.preventDefault();     
   }); 
   $('#DotationTypematerielId').on('change',function(){
       if (this.value != ''){
           $('#DotationMaterielinformatiquesId').parent().children().children('button').addClass('disabled');
       } else {
           $('#DotationMaterielinformatiquesId').parent().children().children('button').removeClass('disabled');
       }
   });   
   /** Changement de l'avancement d'une action **/
   $('#ActionAVANCEMENT').on('change',function(e){
       e.preventDefault();
       var avancement = $('#ActionAVANCEMENT').val() < 0 ? 0 : $('#ActionAVANCEMENT').val() > 100 ? 100 : $('#ActionAVANCEMENT').val();
       avancement = Math.round(avancement/10)*10;
       $('#ActionAVANCEMENT').val(avancement);
       $('#progressbar').attr('style',"width:"+avancement+"%;");
   });
   $('#ActionDUREEPREVUE').on('change',function(e){
       e.preventDefault();
       var jour = ($('#ActionDUREEPREVUE').val()/8) > 1 ? ' jours' : ' jour';
       $('#ActionLblDUREEPREVUE').text(($('#ActionDUREEPREVUE').val()/8)+jour);       
   });
   $('#ActionDUREEREELLE').on('change',function(e){
       e.preventDefault();
       var jour = ($('#ActionDUREEREELLE').val()/8) > 1 ? ' jours' : ' jour';
       $('#ActionLblDUREEREELLE').text(($('#ActionDUREEREELLE').val()/8)+jour);       
   });
   $('#ActionSTATUT').on('change',function(e){
       e.preventDefault();
       if ($('#ActionSTATUT').val() == 'terminée' || $('#ActionSTATUT').val() == 'livré') {
            avancement = 100;
            $('#ActionAVANCEMENT').val(avancement);
            $('#progressbar').attr('style',"width:"+avancement+"%;");           
       } else {
             avancement = 0;
            $('#ActionAVANCEMENT').val(avancement);
            $('#progressbar').attr('style',"width:"+avancement+"%;");          
       }
   });
      /** Accordion **/
   /*$("#accordion2").on('click',function(){
       $(this).find('.accordion-body').each(function(index){
           alert('click on accordion!'+" : "+index+" in ? "+$(this).hasClass('in'))
           $(this).collapse('hide');
        });
       
   });
   $("#expand").on("click", function(){
       if (!$(this).hasClass('disabled')){
            $(this).parents().find('.accordion-body').each(function(index){
                //alert('test1 - '+$(this).attr('id')+" : "+index)
                    $(this).removeAttr('style')
                if (!$(this).hasClass('in')) {
                    //alert('show - '+$(this).attr('id')+" : "+index)
                    $(this).collapse('show');
                }
            })
       //$(this).parents().find('#accordion2 *.accordion-body').collapse('show');
       $(this).addClass('disabled')
       $(this).parents().find('#collapse').removeClass('disabled');
       }
   });
   $("#collapse").on("click", function(){
       if (!$(this).hasClass('disabled')){       
            $(this).parents().find('.accordion-body').each(function(index){
                $(this).removeAttr('style')
                if ($(this).hasClass('in')) {
                    //alert('hide - '+$(this).attr('id')+" : "+index)
                    $(this).collapse('hide');
                }
            })       
       //$(this).parents().find('#accordion2 *.accordion-body').collapse('hide');
       $(this).addClass('disabled')
       $(this).parents().find('#expand').removeClass('disabled');   
       }
   });*/
});
</script>

