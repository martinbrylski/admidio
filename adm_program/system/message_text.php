<?php
/******************************************************************************
 * Texte fuer Hinweistexte oder Fehlermeldungen
 *
 * Copyright    : (c) 2004 - 2009 The Admidio Team
 * Homepage     : http://www.admidio.org
 * Module-Owner : Markus Fassbender
 * License      : GNU Public License 2 http://www.gnu.org/licenses/gpl-2.0.html
 *
 *****************************************************************************/

$message_text = array(

'send_new_login' =>
    'Möchtest du %VAR1% eine E-Mail mit dem Benutzernamen
    und einem neuen Passwort zumailen?',

'max_members' =>
    'Speichern nicht möglich, die maximale Mitgliederzahl würde überschritten.',

'max_members_profile' =>
    'Speichern nicht möglich, bei der Rolle &bdquo;%VAR1%&rdquo;
    würde die maximale Mitgliederzahl überschritten werden.',

'max_members_roles_change' =>
    'Speichern nicht möglich, die Rolle hat bereits mehr Mitglieder als die von dir eingegebene Begrenzung.',

'quota_exceeded' =>
    'Es dürfen maximal so viele Teilnehmer insgesamt in allen Rollen (<b>Kontigentierung</b>) sein wie Teilnehmer 
    insgesamt (<b>Teilnehmerbegrenzung</b>)',
    
'quota_with_maximum' =>
    'Eine <b>Kontingentierung</b> kann nur bei einer <b>Teilnehmerbegrenzung</b> stattfinden',

'quota_for_role' =>
    'Es kann nur ein Kontingent für eine Rolle angegeben werden, für die der Termin auch sichtbar ist.',

'quota_and_max_members_must_match' =>
    'Werden alle teilnehmenden Rollen kontingentiert, muss die Anzahl der Summe der Kontingentierungen mit
    der maximalen Teilnehmerzahl bzw. der Raumkapazität übereinstimmen.',

// Meldungen Listen

'no_old_roles' =>
    'Es sind noch keine Rollen aus dem System entfernt worden.<br /><br />
    Erst wenn du in der Rollenverwaltung Rollen löschst, erscheinen diese automatisch bei
    den "Entfernten Rollen".',

'no_enabled_lists' =>
    'Du besitzt keine Rechte Listen der hinterlegten Rollen anzuschauen.',

// Ende Meldungen Listen

//Meldungen Anmeldung im Forum

'login_forum_pass' =>
    'Dein Password im Forum %VAR2% wurde auf das Admidio-Password zurückgesetz.<br />
    Verwende beim nächsten Login im Forum dein Admidio-Password.<br /><br />
    Du wurdest erfolgreich auf Admidio und <br />im Forum %VAR2%
    als User %VAR1% angemeldet.',

'login_forum_admin' =>
    'Dein Administrator-Account vom Forum %VAR2% wurde auf den
    Admidio-Account zurückgesetz.<br />
    Verwende beim nächsten Login im Forum deinen Admidio-Usernamen und dein Admidio-Password.<br /><br />
    Du wurdest erfolgreich auf Admidio und <br />im Forum %VAR2%
    als User %VAR1% angemeldet.',

'login_forum_new' =>
    'Dein Admidio-Account wurde in das Forum %VAR2% exportiert und angelegt.<br />
    Verwende beim nächsten Login im Forum deinen Admidio-Usernamen und dein Admidio-Password.<br /><br />
    Du wurdest erfolgreich auf Admidio und <br />im Forum %VAR2%
    als User %VAR1% angemeldet.',

'logout_forum' =>
    'Du wurdest erfolgreich auf Admidio und <br />im Forum abgemeldet.',

'login_name_forum' =>
    'Der gewählte Benutzername existiert im Forum schon.<br /><br />
    Wähle bitte einen anderen Namen.',

'delete_forum_user' =>
    'Der gewählte Benutzername wurde im Forum und in Admidio gelöscht.',

//Ende Meldungen Anmeldung im Forum

//Fehlermeldungen Mitgliederzuordnung
'members_changed' =>
    'Die Änderungen wurden erfolgreich gespeichert.',
//Ende Fehlermeldungen Mitgliederzuordnung

//Fehlermeldungen Gästebuchmodul
'flooding_protection' =>
    'Dein letzter Eintrag im Gästebuch <br />
     liegt weniger als %VAR1% Sekunden zurück.',
//Ende Fehlermeldungen Gästebuchmodul

//Fehlermeldungen Profilfoto
'profile_photo_update' =>
    'Das neue Profilfoto wurde erfolgreich gespeichert.',

'profile_photo_update_cancel' =>
    'Der Vorgang wurde abgebrochen.',

'profile_photo_nopic' =>
    'Es wurde keine Bilddatei ausgewählt.',

'profile_photo_deleted' =>
      'Das Profilfoto wurde gelöscht.',

'profile_photo_2big' =>
    'Das hochgeladene Foto übersteigt die vom Server zugelassene
    Dateigröße von %VAR1% B.',

'profile_photo_resolution_2large' =>
    'Die Auflösung des hochgeladenen Bildes übersteigt die vom Server zugelassene Auflösung von %VAR1% Megapixeln.',
 //Ende Fehlermeldungen Profilfoto

// Passwort

'lost_password_send' =>
    'Das neue Passwort wurde an die Email Addresse %VAR1% geschickt!',

'lost_password_send_error' =>
    'Es ist ein Fehler beim Senden an die Email Addresse %VAR1% aufgetreten!<br /> Bitte versuch es später wieder!',

'lost_password_email_error' =>
    'Es konnte die E-Mail Addresse: %VAR1% im System nicht gefunden werden!',

'lost_password_allready_logged_in' =>
    'Du bist am System angemeldet folglich kennst du ja dein Passwort!',

'password_activation_id_not_valid' =>
    'Es wurde entweder schon das Passwort aktiviert oder der Aktivierungscode ist falsch!',

'password_activation_password_saved'=>
    'Das neue Passwort wurde nun übernommen!',
//Ende Password

// Grußkarte
'ecard_send_error'=>
    'Es ist ein Fehler bei der Verarbeitung der Grußkarte aufgetreten. Bitte probier es zu einem späteren Zeitpunkt noch einmal.',

'ecard_feld_error'=>
    'Es sind einige Eingabefelder nicht bzw. nicht richtig ausgefüllt. Bitte füll diese aus, bzw. korrigier diese.',

//Ende Grußkarte

//Fehlermeldungen Fotomodul
'no_photo_folder'=>
    'Der Ordner adm_my_files/photos wurde nicht gefunden.',

'photodateiphotoup' =>
    'Du hast keine Fotodateien ausgewählt, die hinzugefügt
    werden sollen.<br />',

'photoverwaltunsrecht' =>
    'Nur eingeloggte Benutzer mit Fotoverwaltungsrecht dürfen Fotos verwalten.<br />',

'dateiendungphotoup' =>
    'Es können nur Fotos im JPG und PNG-Format hochgeladen und angezeigt werden.<br />',

'startvorend' =>
    'Das eingegebene Enddatum liegt vor dem Anfangsdatum.<br />',

'delete_photo' =>
    'Soll das ausgewählte Foto wirklich gelöscht werden?',

'photo_deleted' =>
    'Das Foto wurde erfolgreich gelöscht.',

'photo_2big' =>
    'Eine der Dateien oder alle gemeinsam übersteigen die vom Server zugelassenen Uplodgröße von %VAR1% MB.',

'empty_photo_post' =>
    'Die Seite wurde ungültig aufgerufen oder die Datei(en) konnte nicht hochgeladen werden.<br />
    Vermutlich wurde die vom Server vorgegebene, maximale Uploadgröße
    von %VAR1%B. übersteigen!',
//Ende Fehlermeldungen Fotomodul

//Fehlermeldungen Forum

'forum_access_data' =>
    'Es wurden entweder die Felder für die Zugangsdaten des Forums nicht oder nicht richtig ausgefüllt!',

'forum_db_connection_failed' =>
    'Es konnte keine Verbindung zur Forumsdatenbank hergestellt werden! Überprüfe bitte die Zugangsdaten auf Richtigkeit!',

// Ende Fehlermeldungen Forum

//Fehlermeldungen Downloadmodul
'invalid_folder' =>
    'Du hast einen ungültigen Ordner aufgerufen!',

'invalid_file' =>
    'Du hast eine ungültigen Datei aufgerufen!',

'invalid_file_name' =>
    'Der ausgwählte Dateiname enthält ungültige Zeichen!<br /><br />
    Wähle bitte einen anderen Namen für die Datei aus.',

'invalid_folder_name' =>
    'Der ausgwählte Ordnername enthält ungültige Zeichen!<br /><br />
    Wähle bitte einen anderen Namen für den Ordner aus.',

'invalid_file_extension' =>
    'Dateien dieses Dateityps sind auf dem Server nicht erlaubt.',

'folder_not_exist' =>
    'Der aufgerufene Ordner existiert nicht.',

'delete_error' =>
    'Beim Löschen ist ein unbekannter Fehler aufgetreten.',

'upload_file' =>
    'Die Datei %VAR1% wurde hochgeladen.',

'add_file' =>
    'Die Datei %VAR1% wurde der Datenbank hinzugefuegt.',

'add_folder' =>
    'Der Ordner %VAR1% wurde der Datenbank hinzugefuegt.',

'create_folder' =>
    'Der Ordner %VAR1% wurde angelegt.',

'folder_exists' =>
    'Der Ordner %VAR1% existiert bereits!<br /><br />
    Wähle bitte einen anderen Namen für den Ordner aus.',

'file_exists' =>
    'Die Datei %VAR1% existiert bereits!<br /><br />
    Wähle bitte einen anderen Dateinamen aus.',

'rename_folder' =>
    'Der Ordner %VAR1% wurde umbenannt.',

'rename_file' =>
    'Die Datei %VAR1% wurde umbenannt.',

'rename_folder_error' =>
    'Beim Umbenennen des Ordners %VAR1% ist ein Fehler aufgetreten.',

'rename_file_error' =>
    'Beim Umbenennen der Datei %VAR1% ist ein Fehler aufgetreten.',

'file_2big' =>
    'Die hochgeladene Datei übersteigt die zulässige
    Dateigröße von %VAR1% KB.',

'file_2big_server' =>
    'Die hochgeladene Datei übersteigt die vom Server zugelassene
    Dateigröße von %VAR1%.',

'empty_upload_post' =>
    'Die Seite wurde ungültig aufgerufen oder die Datei konnte nicht hochgeladen werden.<br />
    Vermutlich wurde die vom Server vorgegebene maximale Uploadgröße von %VAR1% B. überschritten!',

'file_upload_error' =>
    'Beim Hochladen der Datei %VAR1% ist ein unbekannter Fehler aufgetreten.',
//Ende Fehlermeldungen Downloadmodul


//Fehlermeldungen Mailmodul

'attachment' =>
    'Dein Dateinanhang konnte nicht hochgeladen werden.<br />
    Vermutlich ist das Attachment zu groß!',

'attachment_or_invalid' =>
    'Die Seite wurde ungültig aufgerufen oder dein Dateinanhang konnte nicht hochgeladen werden.<br />
    Vermutlich ist das Attachment zu groß!',

'mail_rolle' =>
    'Bitte wähle eine Rolle als Adressat der E-Mail aus!',

'profile_mail' =>
    'In deinem <a href="%VAR1%">Profil</a>
    ist keine gültige E-Mailadresse hinterlegt!',

'role_empty' =>
    'Die von dir ausgewählte Rolle enthält keine Mitglieder
     mit gültigen E-Mailadressen, an die eine E-Mail versendet werden kann!',

'usrid_not_found' =>
    'Die Userdaten der übergebenen ID konnten nicht gefunden werden!',

'usrmail_not_found' =>
    'Der User hat keine gültige E-Mailadresse in seinem Profil hinterlegt!',
//Ende Fehlermeldungen Mailmodul


//Fehlermeldungen RSSmodul
'rss_disabled' =>
    'Die RSS-Funktion wurde vom Webmaster deaktiviert',
//Ende Fehlermeldungen RSSmodul

//Fehlermeldungen Capcha-Klasse
'captcha_code' =>
    'Der Bestätigungscode wurde falsch eingegeben.',
//Ende Fehlermeldungen Capcha-Klasse

 )
?>