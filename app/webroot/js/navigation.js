/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $(document).on('click',".ajax",function(e){
        var overlay = jQuery('<div id="overlay"><img src="../img/loading.gif" />  Chargement en cours ...</div>');
        overlay.appendTo(document.body);
        $.get($(this).attr('href'),{},function(data){
            $('#content').empty().append(data);
            //remplir la session
            overlay.remove();
        });   
        return false;
    });
});

