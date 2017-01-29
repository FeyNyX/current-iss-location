<?php
require_once(__WWW__ . '/models/Config.php');
require_once(__WWW__ . '/models/ISS.php');

class IndexController
{
    public function indexAction()
    {
        require_once('views/index/index.php');
    }

    public function errorAction()
    {
        require_once('views/index/error.php');
    }

    public function getISSLocationAction()
    {
        /**
        * Current coordinates are being passed from client side because of limitations of the API (1 request per second),
        * so that way even if we have 100 active users at the same time, there will be no problem with 100 requests per second.
        */
        $latitude = $_REQUEST['lat'];
        $longitude = $_REQUEST['lon'];

        $iss = new ISS($latitude, $longitude);
        echo $iss->getISSLocation();
    }
}
