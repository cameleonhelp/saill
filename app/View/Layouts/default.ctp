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

$cakeDescription = __d('cake_dev', 'OSACT 3.0.0 ');
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
    <div id="debugguer" style="background-color: #cccccc;">SQL Debug :
        <?php echo $this->element('sql_dump'); ?>
        <?php //debug($this->params); ?>
    </div>
    <!-- Modal -->
    <div id="delete-msg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Suppression</h3>
            </div>
            <div class="modal-body">
            <p>Voulez-vous vraiment supprimer cet élément ?</p>
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
        <button class="btn btn-primary">Oui</button>
        </div>
    </div>
    <div id="initpsw-msg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Initialisation du mot de passe</h3>
            </div>
            <div class="modal-body">
            <p>Voulez-vous vraiment initialiser le mot de passe cet élément ?</p>
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
        <button class="btn btn-primary">Oui</button>
        </div>
    </div>    
</body>
</html>
<script>
$.fn.editable.defaults.mode = 'inline';

$(document).ready(function () {
    /** Fermeture du message en cliquant dessus **/
    $('#flashMessage').on('click',function(){$(this).hide();});
    /** Application d'un style sur les select **/
    $('select').selectpicker();
    /** Application d'un style sur les select **/
    $(".yesno").each( function() { $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non"); } 
    );
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
    if ($("[rel=popover]").length) {
        $("[rel=popover]").popover({placement:'bottom',trigger:'click',html:true});
    }  
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
