<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
$uploaddir = './files/calendars';
/**Nettoyage des fichiers de plus de 2 jours*/
foreach (new DirectoryIterator($uploaddir) as $fileInfo) {
    if(!$fileInfo->isDot() && (time() - $fileInfo->getATime() >= 2*24*60*60)) {
        unlink($fileInfo->getPathname());
    }
}
/**fin du nettoyage*/
$uploaddir .= '/';
$image = $_POST['image'];
$image = str_replace('data:image/png;base64,', '', $image);
$image = str_replace(' ', '+', $image);
$data = base64_decode($image);
$filename = $_POST['title'];
$file = $uploaddir.$filename;
$success = file_put_contents($file, $data);
echo $uploaddir.$filename;
?>