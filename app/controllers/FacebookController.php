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
            header('location: ' . APP_URL . '/facebook/profile');
        }else{
            $this->render('facebook/login');
        }
        
    }

    public function profile()
    {

        // If access token session is not set redirect back to login
        if(!isset($_SESSION['facebook_access_token'])) {
            header('location: ' . APP_URL . '/facebook');
        }

        $accessToken = $_SESSION['facebook_access_token'];

        // Attempt to get user info
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

        // Set user data for the view and render view
        $data['facebookName'] = $user->getName();

        $this->render('facebook/profile', $data);

    }

    public function login()
    {

        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['user_photos'];
        $loginUrl = $helper->getLoginUrl(APP_URL .'/facebook/callback', $permissions);

        header('location: ' . $loginUrl);

        exit;

    }

    public function logout()
    {

        $helper = $this->facebook->getRedirectLoginHelper();
        $logoutUrl = $helper->getLogoutUrl($_SESSION['facebook_access_token'], APP_URL .'/facebook');

        // Unset sessions
        unset($_SESSION['facebook_access_token']);

        header('location: ' . $logoutUrl);

    }

    public function callback()
    {

        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        $_SESSION['facebook_access_token'] = (string)$accessToken;

        header('Location: '. APP_URL .'/facebook/profile');

    }

}