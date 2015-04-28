<?php 
/*****************************************************************************/
/** @class HtmlPage
 *  @brief Creates an Admidio specific complete html page
 *
 *  This class creates a html page with head and body and integrates some Admidio
 *  specific elements like css files, javascript files and javascript code. It
 *  also provides some methods to easily add new html data to the page. The generated
 *  page will automatically integrate the choosen theme. You can optional disable the 
 *  integration of the theme files.
 *  @par Examples
 *  @code // create a simple html page with some text
 *  $page = new HtmlPage();
 *  $page->addJavascriptFile($g_root_path.'/adm_program/libs/jquery/jquery.min.js');
 *  $page->addHeadline('A simple Html page');
 *  $page->addHtml('<strong>This is a simple Html page!</strong>');
 *  $page->show();@endcode
 */
/*****************************************************************************
 *
 *  Copyright    : (c) 2004 - 2015 The Admidio Team
 *  Homepage     : http://www.admidio.org
 *  License      : GNU Public License 2 http://www.gnu.org/licenses/gpl-2.0.html
 *
 *****************************************************************************/

class HtmlPage
{
    protected $pageContent;     ///< Contains the custom html of the current page. This will be added to the default html of each page.
    protected $javascriptContent; ///< Contains the custom javascript of the current page. This will be added to the header part of the page.
    protected $javascriptContentExecute; ///< Contains the custom javascript of the current page that should be executed after pageload. This will be added to the header part of the page.
    protected $title;           ///< The title for the html page and the headline for the Admidio content.
    protected $headline;        ///< The main headline for the html page.
    protected $menu;            ///< An object of the menu of this page
    protected $header;          ///< Additional header that could not be set with the other methods. This content will be add to head of html page without parsing.
    protected $hasNavbar;       ///< Flag if the current page has a navbar.
    protected $showMenu;        ///< If set to true then the menu will be included.
    protected $showThemeHtml;   ///< If set to true then the custom html code of the theme for each page will be included.
    protected $cssFiles;        ///< An array with all necessary cascading style sheets files for the html page.
    protected $jsFiles;         ///< An array with all necessary javascript files for the html page.
    protected $rssFiles;        ///< An array with all necessary rss files for the html page.
    protected $printMode;       ///< A flag that indicates if the page should be styled in print mode then no colors will be shown
    
    /** Constructor creates the page object and initialized all parameters
     *  @param $title A string that contains the title/headline for the page.
     */
    public function __construct($title = '')
    {
        global $g_root_path, $gDebug;
    
        $this->pageContent = '';
        $this->header      = '';
        $this->title       = $title;
        $this->headline    = $title;
        $this->menu        = new HtmlNavbar('menu_main_script', $title, $this);
        $this->showMenu    = true;
        $this->showThemeHtml = true;
        $this->printMode   = false;
        $this->hasNavbar   = false;
        $this->hasModal    = false;
        
        if($gDebug)
        {
            $this->cssFiles = array($g_root_path.'/adm_program/libs/bootstrap/css/bootstrap.css');
            $this->jsFiles  = array($g_root_path.'/adm_program/libs/jquery/jquery.js', 
                                    $g_root_path. '/adm_program/system/js/common_functions.js',
                                    $g_root_path.'/adm_program/libs/bootstrap/js/bootstrap.js');
        }
        else
        {
            // if not in debug mode only load the minified files
            $this->cssFiles = array($g_root_path.'/adm_program/libs/bootstrap/css/bootstrap.min.css');
            $this->jsFiles  = array($g_root_path.'/adm_program/libs/jquery/jquery.min.js', 
                                    $g_root_path. '/adm_program/system/js/common_functions.js',
                                    $g_root_path.'/adm_program/libs/bootstrap/js/bootstrap.min.js');
        }
        $this->rssFiles = array();
    }
    
    /** Adds a cascading style sheets file to the html page.
     *  @param $file The url with filename of the css file.
     */
    public function addCssFile($file)
    {
        if(in_array($file, $this->cssFiles) == false)
        {
            $this->cssFiles[] = $file;
        }
    }
    
    /** Add content to the header segment of a html page.
     *  @param $header Content for the html header segement.
     */
    public function addHeader($header)
    {
        $this->header .= $header;
    }
    
    /** Set the h1 headline of the current html page. If the title of the page was not set
     *  until now than this will also be the title.
     *  @param $headline A string that contains the headline for the page.
     */
    public function addHeadline($headline)
    {
        if(strlen($this->title) == 0)
        {
            $this->setTitle($headline);
        }
        
        $this->headline = $headline;
        $this->menu->setName($headline);
    }
    
    /** Adds any html content to the page. The content will be added in the order
     *  you call this method. The first call will place the content at the top of 
     *  the page. The second call below the first etc.
     *  @param $html A valid html code that will be added to the page.
     */
    public function addHtml($html)
    {
        $this->pageContent .= $html;
    } 

    /** Adds any javascript content to the page. The javascript will be added in the order
     *  you call this method.
     *  @param $javascriptCode A valid javascript code that will be added to the header of the page.
     *  @param $executeAfterPageLoad If set to @b true the javascript code will be executed after
     *                               the page is fully loaded.
     */
    public function addJavascript($javascriptCode, $executeAfterPageLoad = false)
    {
        if($executeAfterPageLoad)
        {
            $this->javascriptContentExecute .= $javascriptCode;
        }
        else
        {
            $this->javascriptContent .= $javascriptCode;
        }
    } 

    /** Adds a javascript file to the html page.
     *  @param $file The url with filename of the javascript file.
     */
    public function addJavascriptFile($file)
    {
        if(in_array($file, $this->jsFiles) == false)
        {
            $this->jsFiles[] = $file;
        }
    }
    
    
    public function addDefaultMenu()
    {
        global $gL10n, $gPreferences, $gValidLogin, $gDb, $gCurrentUser;
        
        $this->menu->addItem('menu_item_modules', null, $gL10n->get('SYS_MODULES'), 'application_view_list.png', 'right', 'navbar', 'admidio-default-menu-item');

        if( $gPreferences['enable_announcements_module'] == 1
        || ($gPreferences['enable_announcements_module'] == 2 && $gValidLogin))
        {
            $this->menu->addItem('menu_item_announcements', '/adm_program/modules/announcements/announcements.php',
                                $gL10n->get('ANN_ANNOUNCEMENTS'), 'announcements.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        if($gPreferences['enable_download_module'] == 1)
        {
            $this->menu->addItem('menu_item_download', '/adm_program/modules/downloads/downloads.php',
                                $gL10n->get('DOW_DOWNLOADS'), 'download.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        if($gPreferences['enable_mail_module'] == 1 && $gValidLogin == false)
        {
            $this->menu->addItem('menu_item_email', '/adm_program/modules/messages/messages_write.php',
                                $gL10n->get('SYS_EMAIL'), 'email.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }

        if(($gPreferences['enable_pm_module'] == 1 || $gPreferences['enable_mail_module'] == 1) && $gValidLogin)
        {
			// get number of unread messages for user
			$message = new TableMessage($gDb);
            $unread = $message->countUnreadMessageRecords($gCurrentUser->getValue('usr_id'));

            if ($unread > 0)
            {
                $this->menu->addItem('menu_item_private_message', '/adm_program/modules/messages/messages.php',
                                $gL10n->get('SYS_MESSAGES').'<span class="badge">'.$unread.'</span>', 'messages.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
            }
            else
            {
                $this->menu->addItem('menu_item_private_message', '/adm_program/modules/messages/messages.php',
                                $gL10n->get('SYS_MESSAGES'), 'messages.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
            }
        }
        if($gPreferences['enable_photo_module'] == 1 
        || ($gPreferences['enable_photo_module'] == 2 && $gValidLogin))
        {
            $this->menu->addItem('menu_item_photo', '/adm_program/modules/photos/photos.php',
                                $gL10n->get('PHO_PHOTOS'), 'photo.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        if( $gPreferences['enable_guestbook_module'] == 1
        || ($gPreferences['enable_guestbook_module'] == 2 && $gValidLogin))            
        {
            $this->menu->addItem('menu_item_guestbook', '/adm_program/modules/guestbook/guestbook.php',
                                $gL10n->get('GBO_GUESTBOOK'), 'guestbook.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        
        $this->menu->addItem('menu_item_lists', '/adm_program/modules/lists/lists.php',
                            $gL10n->get('LST_LISTS'), 'lists.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        if($gValidLogin)
        {
            $this->menu->addItem('menu_item_mylist', '/adm_program/modules/lists/mylist.php',
                                $gL10n->get('LST_MY_LIST'), 'mylist.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        
        if( $gPreferences['enable_dates_module'] == 1
        || ($gPreferences['enable_dates_module'] == 2 && $gValidLogin))                    
        {
            $this->menu->addItem('menu_item_dates', '/adm_program/modules/dates/dates.php',
                                $gL10n->get('DAT_DATES'), 'dates.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }

        if( $gPreferences['enable_weblinks_module'] == 1
        || ($gPreferences['enable_weblinks_module'] == 2 && $gValidLogin))            
        {
            $this->menu->addItem('menu_item_links', '/adm_program/modules/links/links.php',
                                $gL10n->get('LNK_WEBLINKS'), 'weblinks.png', 'right', 'menu_item_modules', 'admidio-default-menu-item');
        }
        
        if($gCurrentUser ->isWebmaster() || $gCurrentUser ->manageRoles() || $gCurrentUser ->approveUsers() || $gCurrentUser ->editUsers())
        {
            $this->menu->addItem('menu_item_administration', null, $gL10n->get('SYS_ADMINISTRATION'), 'application_view_list.png', 'right', 'navbar', 'admidio-default-menu-item');
            
            if($gCurrentUser ->approveUsers() && $gPreferences['registration_mode'] > 0)
            {
                $this->menu->addItem('menu_item_registration', '/adm_program/modules/registration/registration.php',
                                    $gL10n->get('NWU_NEW_REGISTRATIONS'), 'new_registrations.png', 'right', 'menu_item_administration', 'admidio-default-menu-item');
            }
            if($gCurrentUser ->editUsers())
            {
                $this->menu->addItem('menu_item_members', '/adm_program/modules/members/members.php',
                                    $gL10n->get('MEM_USER_MANAGEMENT'), 'user_administration.png', 'right', 'menu_item_administration', 'admidio-default-menu-item');
            }
            if($gCurrentUser ->manageRoles())
            {
                $this->menu->addItem('menu_item_roles', '/adm_program/modules/roles/roles.php',
                                    $gL10n->get('ROL_ROLE_ADMINISTRATION'), 'roles.png', 'right', 'menu_item_administration', 'admidio-default-menu-item');
            }
            if($gCurrentUser ->isWebmaster())
            {
                $this->menu->addItem('menu_item_backup', '/adm_program/modules/backup/backup.php',
                                    $gL10n->get('BAC_DATABASE_BACKUP'), 'backup.png', 'right', 'menu_item_administration', 'admidio-default-menu-item');
                $this->menu->addItem('menu_item_options', '/adm_program/modules/preferences/preferences.php',
                                    $gL10n->get('SYS_SETTINGS'), 'options.png', 'right', 'menu_item_administration', 'admidio-default-menu-item');
            }
        }
        
        if($gValidLogin)
        {
            // show link to own profile
            $this->menu->addItem('menu_item_my_profile', '/adm_program/modules/profile/profile.php', $gL10n->get('PRO_MY_PROFILE'), 'profile.png', 'right', 'navbar', 'admidio-default-menu-item');
            // show logout link
            $this->menu->addItem('menu_item_logout', '/adm_program/system/logout.php', $gL10n->get('SYS_LOGOUT'), 'door_in.png', 'right', 'navbar', 'admidio-default-menu-item');
        }
        else
        {
            // show registration link
            $this->menu->addItem('menu_item_registration', '/adm_program/modules/registration/registration.php', $gL10n->get('SYS_REGISTRATION'), 'new_registrations.png', 'right', 'navbar', 'admidio-default-menu-item');
            // show login link
            $this->menu->addItem('menu_item_login', '/adm_program/system/login.php', $gL10n->get('SYS_LOGIN'), 'key.png', 'right', 'navbar', 'admidio-default-menu-item');
        }
    }
    
    /** Adds a RSS file to the html page.
     *  @param $file  The url with filename of the rss file.
     *  @param $title Optional set a title. This is the name of the feed and
     *                will be shown when adding the rss feed.
     */
    public function addRssFile($file, $title = null)
    {
        if($title != null)
        {
            $this->rssFiles[$title] = $file;
        }
        else
        {
            $this->rssFiles[] = $file;            
        }
    }
    
    /** Returns the menu object of this html page.
     *  @return Returns the menu object of this html page.
     */ 
    public function getMenu()
    {
        return $this->menu;
    }
    
    /** Returns the title of the html page.
     *  @return Returns the title of the html page.
     */ 
    public function getTitle()
    {
        return $this->title;
    }
    
    /** Every html page of Admidio contains a menu. If the menu should 
     *  not be included in the current page, than this method must be called.
     */
    public function hideMenu()
    {
        $this->showMenu = false;
    }
        
    /** Every html page of Admidio contains three files of the custom theme.
     *  my_header.php, my_body_top.php and my_body_bottom.php
     *  With these files the webmaster can contain custom layout to Admidio.
     *  If these files should not be included in the current page, than
     *  this method must be called.
     */
    public function hideThemeHtml()
    {
        $this->showThemeHtml = false;
    }
    
    /** Flag if the current page has a navbar.
     */
    public function hasNavbar()
    {
        $this->hasNavbar = true;
    }
    
    /** If print mode is set then a print specific css file will be loaded.
     *  All styles will be more print compatible and are only black, grey and white.
     */
    public function setPrintMode()
    {
        $this->printMode = true;
    }
        
    /** Set the title of the html page. This will also be the h1 headline for the Admidio page.
     *  @param $title A string that contains the title for the page.
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

	/** This method send the whole html code of the page to the browser. Call this method
	 *  if you have finished your page layout.
     *  @param $directOutput If set to @b true (default) the html page will be directly send
     *                       to the browser. If set to @b false the html will be returned.
     *  @return If $directOutput is set to @b false this method will return the html code of the page.
	 */
    public function show($directOutput = true)
    {
        global $g_root_path, $gL10n, $gDb, $gCurrentSession, $gCurrentOrganization, $gCurrentUser, $gPreferences, $gValidLogin;
        
        $newLayout        = true;
        $headerContent    = '';
        $htmlMyHeader     = '';
        $htmlMyBodyTop    = '';
        $htmlMyBodyBottom = '';
        $htmlMenu         = '';
        $htmlHeadline     = '';
        
        if($this->showMenu)
        {
            // add modules and administration modules to the menu
            $this->addDefaultMenu();
            $htmlMenu = $this->menu->show(false);
        }
        
        if(strlen($this->headline) > 0)
        {
            $htmlHeadline = '<h1>'.$this->headline.'</h1>';
        }
        
        // add admidio css file at last because there the user can redefine all css
        $this->addCssFile(THEME_PATH.'/css/admidio.css');
        
        // if print mode is set then add a print specific css file
        if($this->printMode)
        {
            $this->addCssFile(THEME_PATH.'/css/print.css');
        }
        
        // load content of theme files
        if($this->showThemeHtml)
        {
            ob_start();
            include(THEME_SERVER_PATH. '/my_header.php');
            $htmlMyHeader = ob_get_contents();
            ob_end_clean();

            ob_start();
            include(THEME_SERVER_PATH. '/my_body_top.php');
            $htmlMyBodyTop = ob_get_contents();
            ob_end_clean();

            // if user had set another db in theme content then switch back to admidio db
            $gDb->setCurrentDB();

            ob_start();
            include(THEME_SERVER_PATH. '/my_body_bottom.php');
            $htmlMyBodyBottom = ob_get_contents();
            ob_end_clean();

            // if user had set another db in theme content then switch back to admidio db
            $gDb->setCurrentDB();
        }
        
        // add css files to page
        foreach($this->cssFiles as $file)
        {
            $headerContent .= '<link rel="stylesheet" type="text/css" href="'.$file.'" />';
        }
        
        // add some special scripts so that ie8 could better understand the Bootstrap 3 framework
        $headerContent .= '<!--[if lt IE 9]>  
            <script src="'.$g_root_path.'/adm_program/libs/html5shiv/html5shiv.min.js"></script>
            <script src="'.$g_root_path.'/adm_program/libs/respond/respond.js"></script>
        <![endif]-->';
        
        // add javascript files to page
        foreach($this->jsFiles as $file)
        {
            $headerContent .= '<script type="text/javascript" src="'.$file.'"></script>';
        }

        // add rss feed files to page
        foreach($this->rssFiles as $title => $file)
        {
            if(is_numeric($title) == false)
            {
                $headerContent .= '<link rel="alternate" type="application/rss+xml" title="'.$title.'" href="'.$file.'" />';
            }
            else
            {
                $headerContent .= '<link rel="alternate" type="application/rss+xml" href="'.$file.'" />';                
            }
        }
        
        // add organization name to title
        if(strlen($this->title) > 0)
        {
            $this->title = $gCurrentOrganization->getValue('org_longname').' - '.$this->title;
        }
        else
        {
        	$this->title = $gCurrentOrganization->getValue('org_longname');
        }
        
        // add code for a modal window
        $this->addJavascript('$("body").on("hidden.bs.modal", ".modal", function () { $(this).removeData("bs.modal"); });', true);
        $this->addHtml('<div class="modal fade" id="admidio_modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog"><div class="modal-content"></div></div>
                        </div>');

        // add javascript code to page        
        if(strlen($this->javascriptContent) > 0)
        {
            $headerContent .= '<script type="text/javascript"><!-- 
                '.$this->javascriptContent.'
            --></script>';
        }

        // add javascript code to page that will be excecuted after page is fully loaded       
        if(strlen($this->javascriptContentExecute) > 0)
        {
            $headerContent .= '<script type="text/javascript"><!-- 
                $(document).ready(function(){
                    $(".admidio-icon-info, .admidio-icon-link img, [data-toggle=tooltip]").tooltip();
                    '.$this->javascriptContentExecute.'
                });
            --></script>';
        }
        
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <!-- (c) 2004 - 2014 The Admidio Team - http://www.admidio.org -->
            
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <title>'.$this->title.'</title>

            <script type="text/javascript"><!-- 
        		var gRootPath  = "'. $g_root_path. '"; 
        		var gThemePath = "'. THEME_PATH. '";
        	--></script>';
            
            $html .= $headerContent;
            
            if(strlen($this->header) > 0)
            {
                $html .= $this->header;
            }
            
            $html .= $htmlMyHeader.'
        </head>
        <body>'.
            $htmlMyBodyTop.'
            <div class="admContent">
                '.$htmlHeadline.$htmlMenu.$this->pageContent.'
            </div>'.
            $htmlMyBodyBottom.'          
        </body>
        </html>';
        
        if($this->hasNavbar == true)
        {
            // set css clss to hide headline in mobile mode if navbar is shown
            $html = str_replace('<h1>'.$this->headline.'</h1>', '<h1 class="hidden-xs">'.$this->headline.'</h1>', $html);
        }

        // now show the complete html of the page
        if($directOutput)
        {
            header('Content-type: text/html; charset=utf-8'); 
            echo $html;
        }
        else
        {
            return $html;
        }
    }
}
?>