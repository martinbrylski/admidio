<?php
/******************************************************************************
 * Uebersicht und Pflege aller organisationsspezifischen Profilfelder
 *
 * Copyright    : (c) 2004 - 2009 The Admidio Team
 * Homepage     : http://www.admidio.org
 * License      : GNU Public License 2 http://www.gnu.org/licenses/gpl-2.0.html
 *
 ****************************************************************************/

require('../../system/common.php');
require('../../system/login_valid.php');
require('../../system/classes/table_rooms.php');

// nur berechtigte User duerfen die Profilfelder bearbeiten
if (!$g_current_user->isWebmaster())
{
    $g_message->show($g_l10n->get('SYS_PHR_NO_RIGHTS'));
}

$g_layout['header'] = '
    <script type="text/javascript" src="'.$g_root_path.'/adm_program/system/js/ajax.js"></script>
    <script type="text/javascript" src="'.$g_root_path.'/adm_program/system/js/delete.js"></script>'; 


unset($_SESSION['rooms_request']);
// Navigation weiterfuehren
$_SESSION['navigation']->addUrl(CURRENT_URL);

$req_headline = 'Raum';
$req_id       = 0;
require(THEME_SERVER_PATH. '/overall_header.php');
 // Html des Modules ausgeben
echo '<h1 class="moduleHeadline">Raumverwaltung</h1>
<span class="iconTextLink">
    <a href="'.$g_root_path.'/adm_program/administration/rooms/rooms_new.php?headline='.$req_headline.'"><img src="'. THEME_PATH. '/icons/add.png" alt="Rolle anlegen" /></a>
    <a href="'.$g_root_path.'/adm_program/administration/rooms/rooms_new.php?headline='.$req_headline.'">Raum anlegen</a>
</span>
<br/>';

$sql = 'SELECT room.*, 
               cre_surname.usd_value as create_surname, cre_firstname.usd_value as create_firstname,
               cha_surname.usd_value as change_surname, cha_firstname.usd_value as change_firstname
          FROM adm_rooms room
          LEFT JOIN '. TBL_USER_DATA .' cre_surname 
            ON cre_surname.usd_usr_id = room_usr_id_create
           AND cre_surname.usd_usf_id = '.$g_current_user->getProperty('LAST_NAME', 'usf_id').'
          LEFT JOIN '. TBL_USER_DATA .' cre_firstname 
            ON cre_firstname.usd_usr_id = room_usr_id_create
           AND cre_firstname.usd_usf_id = '.$g_current_user->getProperty('FIRST_NAME', 'usf_id').'
          LEFT JOIN '. TBL_USER_DATA .' cha_surname 
            ON cha_surname.usd_usr_id = room_usr_id_change
           AND cha_surname.usd_usf_id = '.$g_current_user->getProperty('LAST_NAME', 'usf_id').'
          LEFT JOIN '. TBL_USER_DATA .' cha_firstname 
            ON cha_firstname.usd_usr_id = room_usr_id_change
           AND cha_firstname.usd_usf_id = '.$g_current_user->getProperty('FIRST_NAME', 'usf_id').'
         ORDER BY room_name';
$rooms_result = $g_db->query($sql);

if($g_db->num_rows($rooms_result) == 0)
{
    // Keine Räume gefunden
    if($req_id > 0)
    {
        echo '<p>'.$g_l10n->get('SYS_PHR_NO_ENTRY').'</p>';
    }
    else
    {
        echo '<p>'.$g_l10n->get('SYS_PHR_NO_ENTRIES').'</p>';
    }
}
else
{
    $room = new TableRooms($g_db);
    //Räume auflisten
    while($row=$g_db->fetch_array($rooms_result))
    {
        // GB-Objekt initialisieren und neuen DS uebergeben
        $room->clear();
        $room->setArray($row);
        
        echo '<br/>
        <div class="boxLayout" id="room_'.$room->getValue('room_id').'">
            <div class="boxHead">
                <div class="boxHeadLeft">
                    <img src="'.$g_root_path.'/adm_themes/classic/icons/home.png" alt="'. $room->getValue('room_name'). '" />'
                    
                     . $room->getValue('room_name').'
                </div>
                <div class="boxHeadRight">';
                    if ($g_current_user->editDates())
                    {
                        //Bearbeiten
                        echo '
                        <a class="iconLink" href="'.$g_root_path.'/adm_program/administration/rooms/rooms_new.php?room_id='. $room->getValue('room_id'). '&amp;headline='.$req_headline.'"><img src="'. THEME_PATH. '/icons/edit.png" alt="Bearbeiten" title="Bearbeiten" /></a>';
                            
                        //Löschen
                        echo '
                        <a class="iconLink" href="javascript:deleteObject(\'room\', \'room_'.$room->getValue('room_id').'\','.$room->getValue('room_id').',\''.$room->getValue('room_name').'\')"><img src="'. THEME_PATH. '/icons/delete.png" alt="L&ouml;schen" title="L&ouml;schen" /></a>';
                    }
          echo '</div>
            </div>
            <div class="boxBody">
                <div class="date_info_block">
                    <table style="float:left; width: 200px;">
                        <tr>
                            <td>Kapazität:</td>
                            <td><strong>'.$room->getValue('room_capacity').'</strong></td>
                        </tr>';
                        if($room->getValue('room_overhang')!=null)
                        {
                            echo '<tr>
                                    <td>Überhang:</td>
                                    <td><strong>'.$room->getValue('room_overhang').'</strong></td>
                                  </tr>';
                        }
                    echo '</table>';
                    if($room->getValue('room_description')!=null)
                    {
                       echo '<div class="date_description" style="clear: left;"><br/>'
                            .$room->getDescription('HTML').'</div>';
                    }
                    echo '<div class="editInformation">'.
                    $g_l10n->get('SYS_PHR_CREATED_BY', $row['create_firstname']. ' '. $row['create_surname'], $room->getValue('dat_timestamp_create'));

                    if($room->getValue('dat_usr_id_change') > 0)
                    {
                        echo '<br />'.$g_l10n->get('SYS_PHR_LAST_EDITED_BY', $row['change_firstname']. ' '. $row['change_surname'], $room->getValue('dat_timestamp_change'));
                    }
                echo '</div>
                </div>
            </div>
        </div>';
    }
}

echo '
<ul class="iconTextLinkList">
    <li>
        <span class="iconTextLink">
            <a href="'.$g_root_path.'/adm_program/system/back.php"><img 
            src="'. THEME_PATH. '/icons/back.png" alt="'.$g_l10n->get('SYS_BACK').'" /></a>
            <a href="'.$g_root_path.'/adm_program/system/back.php">'.$g_l10n->get('SYS_BACK').'</a>
        </span>
    </li>
</ul>';

 
require(THEME_SERVER_PATH. '/overall_footer.php');
?>