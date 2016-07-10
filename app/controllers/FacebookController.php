<?php

use Facebook\Facebook;

class FacebookController extends Controller {

    protected $facebook;

    function __construct() 
    {

        parent::__construct();

        $this->facebook = new Facebook([
            'app_id' => $GLOBALS['config']['facebook']['app_id'],
            'app_secret' => $GLOBALS['config']['facebook']['app_secret'],
            'default_graph_version' => 'v2.5'
        ]);

    }

    public function index()
    {
        
        if(isset($_SESSION['facebook_access_token'])){

            $accessToken = $_SESSION['facebook_access_token'];

            try {
                $response = $this->facebook->get('/me', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $user = $response->getGraphUser();

            $_SESSION['facebook_name'] = $user->getName();

            $this->render('facebookView');
        }else{
            $this->render('facebook');
        }
        
    }

    public function login()
    {

        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes'];
        $loginUrl = $helper->getLoginUrl(APP_URL .'facebook/callback', $permissions);

        header('location: ' . $loginUrl);

        exit;

    }

    public function logout()
    {

        $helper = $this->facebook->getRedirectLoginHelper();
        $logoutUrl = $helper->getLogoutUrl($_SESSION['facebook_access_token'], APP_URL .'facebook');

        // Unset sessions
        unset($_SESSION['facebook_name']);
        unset($_SESSION['facebook_access_token']);

        header('location: ' . $logoutUrl);
        exit;
    }

    public function callback()
    {

        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Exception $e){
            echo 'Error: ' . $e->getMessage();
            exit;
        }
        if (isset($accessToken)) {
            // Store access token in session.
            $_SESSION['facebook_access_token'] = (string)$accessToken;
            header('Location: '. APP_URL .'facebook');
            exit;
        } elseif($helper->getError()) {
            var_dump($helper->getError());
            var_dump($helper->getErrorCode());
            var_dump($helper->getErrorDescription());
        }

    }

}