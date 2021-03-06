<?php
/*
 * Leap System eLearning
 * Each line should be prefixed with  * 
 */
use Leap\InitLeap;

/**
 * Description of Init
 *
 * @author User
 */
class Init extends InitLeap
{

    protected $arrDBSetting = array(
        "mhssd" => array("serverpath" => "localhost", "db_username" => "root", "db_password" => "1qay2wsx", "db_name" => "leap_demo_2-3", "db_prefix" => ""),
        "mhssmp" => array("serverpath" => "localhost", "db_username" => "root", "db_password" => "1qay2wsx", "db_name" => "leap_demo_2-3", "db_prefix" => ""),
        "mhstk" => array("serverpath" => "localhost", "db_username" => "root", "db_password" => "1qay2wsx", "db_name" => "leap_demo_2-3", "db_prefix" => "")
    );
    protected $photoUrl = array(
        "mhssd" => array("photo_path" => "D:/xampp/htdocs/static/mhssd/", "photo_url" => "http://localhost/static/mhssd/"),
        "mhssmp" => array("photo_path" => "D:/xampp/htdocs/static/mhssmp/", "photo_url" => "http://localhost/static/mhssmp/"),
        "mhstk" => array("photo_path" => "D:/xampp/htdocs/static/mhstk/", "photo_url" => "http://localhost/static/mhstk/")
    );

//    protected $arrDBSetting = array(
//        "mhssd"=>array("serverpath"=>"localhost","db_username"=>"c1nt466_user2 ","db_password"=>"1qay2wsx88","db_name"=>"c1nt466_leapdemo2","db_prefix"=>"")
//        
//        );
//    protected $photoUrl = array(
//        "mhssd"=>array("photo_path"=>"/home/c1nt466/public_html/static/demo2/","photo_url"=>"http://static.leap-systems.com/demo2/")
//        );

    public function __construct($mainClass, $DbSetting, $WebSetting, $timezone, $js, $css, $nameSpaceForApps)
    {
        parent::__construct($mainClass);

        //start session if needed
        //if(!$this->is_session_started())

        // init whats needed //kalau ga perlu bisa dihilangkan tergantung kebutuhan
        //set globals
        $this->setGlobalVariables($WebSetting);

        //Initialize DB
        // DbChooser::setDBSelected();
        //DB setting di access di overwrite spy bisa ada choosernya...
        //$skolahDB = DbChooser::getDBSelected();
        //$DbSetting = $this->arrDBSetting[$skolahDB];
        global $DbSetting;
        $this->setDB($DbSetting);

        //overwrite global variable to set photopath for different schools
        global $photo_path;
        global $photo_url;
        define('_PHOTOPATH', $photo_path);
        define('_PHOTOURL', $photo_url);

        //Init Template
        $this->setTemplate($WebSetting);
        //Init Web Parameter
        $this->setParams();
        //Init Timezone
        $this->setTimezone($timezone);

        //Init Mobile Check in untuk menentukan default
        $this->setHardwareType();
        if ($this->getHardwareType() == "mobile")
            Mobile::setMobile(1);

        //cek to mobile get
        Mobile::checkGetMobile();

        //$nameSpaceForApps        
        $this->setNameSpacesForApps($nameSpaceForApps);
        //add css and js
        $this->template->addFilesToHead($js);
        $this->template->addFilesToHead($css);
        //run it
        //$this->run();
    }


}
