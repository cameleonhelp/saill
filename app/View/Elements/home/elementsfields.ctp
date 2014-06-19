<div style="padding-top: 15px;">
    <h4>Liste des fichiers d'aide à votre disposition:</h4>
    <?php if(in_array(userAuth('profil_id'),array(-2,1,17))): ?>
        <?php echo $this->element('modals/addfiles'); ?>
    <?php endif; ?>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" style="width: 100% !important;">
    <thead>
    <tr>
        <?php $nbrow = in_array(userAuth('profil_id'),array(-2,1,17)) ? 6 : 5; ?>
        <th colspan="<?php echo $nbrow; ?>">Nom du fichier<div class="pull-right">
            <?php if (in_array(userAuth('profil_id'),array(-2,1,17))): ?>
                <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modaladdfiles">
                  Ajouter un fichier
                </a>        
            <?php endif; ?>
        </div></th>
    </tr>
    </thead>
    <tbody>
    <?php $dirall = './files/all'; ?>
    <?php $diradm = './files/admin'; ?> 
    <?php //constitution de tableau à partir des directoryIterator
    $arr_files[] = array();
    foreach (new DirectoryIterator($dirall) as $file):
        if(!$file->isDot() && $file->getFilename()!= 'empty' && $file->getFilename()!= '@eaDir'):
            $arr_files[$file->getFilename()]=array("ext"=>pathinfo($file->getFilename(), PATHINFO_EXTENSION),"name"=>$file->getFilename(),'url'=>'.'.$dirall.'/'.$file->getFilename(),'size'=>byteFormat($file->getSize()),'time'=>date('d/m/Y H:i:s',$file->getATime()));
        endif;
    endforeach;
    if(in_array(userAuth('profil_id'),array(-2,1,3,4,5,8,12,13,14,15,17))):
    foreach (new DirectoryIterator($diradm) as $file):
        if(!$file->isDot() && $file->getFilename()!= 'empty' && $file->getFilename()!= '@eaDir'):
            $arr_files[$file->getFilename()]=array("ext"=>pathinfo($file->getFilename(), PATHINFO_EXTENSION),"name"=>$file->getFilename(),'url'=>'.'.$dirall.'/'.$file->getFilename(),'size'=>byteFormat($file->getSize()),'time'=>date('d/m/Y H:i:s',$file->getATime()));
        endif;
    endforeach;
    endif;
    asort($arr_files);
    ?>     
    <?php foreach ($arr_files as $arr_file): ?>
        <?php if(count($arr_file)>0): ?>
        <tr>
        <td style="text-align:center;line-height: 4px;"><span class="<?php echo $arr_file['ext'] != '' ?'ico-'.$arr_file['ext']  : 'icon-blank' ;?>"></span></td>
        <td><?php echo $arr_file['name']; ?></td>
        <td style="text-align: center;"><?php echo $arr_file['time']; ?></td>
        <td style="text-align: center;"><?php echo $arr_file['size']; ?></td>
            <?php if (in_array(userAuth('profil_id'),array(-2,1,17))): ?>
            <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>',array('controller'=>'fileshareds','action'=>'deletefile',  str_replace('/', '+', $arr_file['url'])),array('escape' => false), __('Etes-vous certain de vouloir supprimer ce fichier du partage.')); ?>&nbsp;</td>
            <?php endif; ?>
            <td style="text-align:center;line-height: 4px;"><?php echo $this->Html->link('<span class="glyphicons download_alt notchange"></span>',$arr_file['url'],array('target'=>'blank','escape' => false)); ?>&nbsp;</td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>