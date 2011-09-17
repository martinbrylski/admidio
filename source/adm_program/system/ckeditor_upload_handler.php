<?php
/******************************************************************************
 * Uploads aus dem CKEditor verarbeiten
 *
 * Copyright    : (c) 2004 - 2011 The Admidio Team
 * Homepage     : http://www.admidio.org
 * License      : GNU Public License 2 http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Parameters:
 *
 * CKEditor        : ID der Textarea, die den Upload ausgelöst hat
 * CKEditorFuncNum : Funktionsnummer, die im Editor die neue URL verarbeitet
 * langCode        : Sprachcode
 *
 *****************************************************************************/

require_once('common.php');
require_once('login_valid.php');
require_once('classes/image.php');
require_once('classes/my_files.php');

$message = '';

//pruefen ob in den aktuellen Servereinstellungen file_uploads auf ON gesetzt ist...
if (ini_get('file_uploads') != '1')
{
    $message = $gL10n->get('SYS_SERVER_NO_UPLOAD');
}

// ggf. Ordner für Uploads in adm_my_files anlegen
if($_GET['CKEditor'] == 'ann_description')
{
    $folderName = 'ANNOUNCEMENTS';
}
$myFilesProfilePhotos = new MyFiles($folderName);
if($myFilesProfilePhotos->checkSettings() == false)
{
    $message = $gL10n->get($myFilesProfilePhotos->errorText, $myFilesProfilePhotos->errorPath, '<a href="mailto:'.$gPreferences['email_administrator'].'">', '</a>');
}


$local_file = $_FILES['upload']['name'];
$server_url = SERVER_PATH.'/adm_my_files/announcements/'.$local_file;
$html_url   = $g_root_path.'/adm_program/system/show_image.php?module=announcements&file='.$local_file;
move_uploaded_file($_FILES['upload']['tmp_name'], $server_url);

$callback = $_GET['CKEditorFuncNum'];
$output = '<html><body><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$callback.', "'.$html_url.'","'.$message.'");</script></body></html>';
echo $output;

?>