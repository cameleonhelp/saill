<div class="changelogversions index">
    <div class="">
        <?php echo $this->element('changelogsubmenu'); ?>
        <button type="button" data-toggle="modal" data-target="#modaladdchangelogversion" class="btn btn-default btn-sm  pull-right" style="margin-bottom:10px;">Ajouter une version</button>  
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width:100%;">
        <thead>
	<tr>
                    <th><?php echo $this->Paginator->sort('Version','Nom'); ?></th>
                    <th><?php echo $this->Paginator->sort('DATEPREVUE','Prévue le'); ?></th>
                    <th width="30px"><?php echo $this->Paginator->sort('ETAT','Etat'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>
	<?php foreach ($changelogversions as $changelogversion): ?>
	<tr>
		<td><?php echo $changelogversion['Changelogversion']['VERSION']; ?>&nbsp;</td>
                <td><?php echo $changelogversion['Changelogversion']['DATEPREVUE']; ?>&nbsp;</td>
		<td style="text-align: center;"><?php $image = $changelogversion['Changelogversion']['ETAT']==0 ? 'unlock' : 'lock disabled'; ?>
                    <a href="#" class="etat cursor showoverlay" data-id="<?php echo $changelogversion['Changelogversion']['id']; ?>"><span class="glyphicons <?php echo $image; ?> notchange"></span></a>
                </td>
                <td  class="actions">
                    <?php if($changelogversion['Changelogversion']['ETAT']==0): ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil notchange"></span>',"#",array('data-id'=>$changelogversion['Changelogversion']['id'],'escape' => false)); ?>&nbsp;
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange"></span>', array('action' => 'delete', $changelogversion['Changelogversion']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette version ?')); ?>                    
                    <?php endif; ?>
                </td>
	</tr>
        <?php endforeach; ?>
        </tbody>
	</table>
        <div class="pull-left">	<?php	echo $this->Paginator->counter('Page {:page} sur {:pages}');	?></div>
        <div class="pull-right"><?php	echo $this->Paginator->counter('Nombre total d\'éléments : {:count}');	?></div>
        <div class='text-center'>
        <ul class="pagination pagination-sm">
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
	?>
        </ul>
        </div>
    </div>
</div>
<?php echo $this->element('modals/addchangelogversion'); ?>
<?php echo $this->element('modals/editchangelogversion'); ?>
<script>
$(document).ready(function () {
    $(document).on('click','.etat',function(e){
        var id = $(this).attr('data-id');
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'changelogversions','action'=>'ajax_changeetat')); ?>/",
                data: ({id:id})
            }).done(function ( data ) {
                location.reload();
            });
    });
    $(document).on('click','.pencil',function(e){
        var id = $(this).parent('a').attr('data-id');
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'changelogversions','action'=>'json_get_info')); ?>/" + id,
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                $('#ChangelogversionId').val(id);
                $('#ChangelogversionDATE').val(json['Changelogversion']['DATEPREVUE']);
                $('#modaleditchangelogversion').modal('show');
            },
            error :function(response,status,errorThrown) {
                alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
            }
         });
    });    
});
</script>