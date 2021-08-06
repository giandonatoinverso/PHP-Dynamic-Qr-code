<?php
session_start();
require_once 'lib/hybridauth/src/autoload.php';
require_once 'lib/Users/SocialAuth.php';
$db = getDbInstance();
$db->where('published', 1);
$providers = $db->objectBuilder()->get('social_setting', null, ['provider','social_key','social_secret']);

$providers_arr = [];
foreach ($providers as $row) {
    $providers_arr[$row->provider] = [
        'enabled' => true,'keys'=>['id'=>$row->social_key,'secret'=>$row->social_secret]
    ];
}
print_r($providers_arr);
use Hybridauth\Hybridauth;

$config = [
    'callback' => base_url().'/social_auth.php',
    // Providers specifics
    'providers' => $providers_arr,
    'debug_mode' => false,
    'debug_file' => __FILE__ . '.log',
];

try {
    // Feed configuration array to Hybridauth
    $hybridauth = new Hybridauth($config);

    // Then we can proceed and sign in with Twitter as an example. If you want to use a diffirent provider,
    // simply replace 'Twitter' with 'Google' or 'Facebook'.

    // Attempt to authenticate users with a provider by name
    // This call will basically do one of 3 things...
    // 1) Redirect away (with exit) to show an authentication screen for a provider (e.g. Facebook's OAuth confirmation page)
    // 2) Finalize an incoming authentication and store access data in a session
    // 3) Confirm a session exists and do nothing
    $adapter = $hybridauth->authenticate($_SESSION['network']);

    // Returns a boolean of whether the user is connected with Twitter

    if ($adapter->isConnected()) {

        // Retrieve the user's profile
        $userProfile = $adapter->getUserProfile();

        // Disconnect the adapter (log out)
        $adapter->disconnect();
        $social_auth = new SocailAuth();
        if (!$social_auth->user_exist($userProfile->email)) {
            $db = getDbInstance();
            $db->where('email', $userProfile->email);
            $row = $db->objectBuilder()->getOne('temp_accounts');
            if ($db->count >= 1) {
                $_SESSION['temp_user_id'] = $row->id;
            } else {
                $data_to_db['email'] = $userProfile->email;
                $data_to_db['first_name'] = $userProfile->firstName;
                $data_to_db['last_name'] = $userProfile->lastName;
                $data_to_db['last_name'] = $userProfile->lastName;
                $data_to_db['network'] = $_SESSION['network'];

                $db = getDbInstance();
                $last_id = $db->insert('temp_accounts', $data_to_db);
                $_SESSION['temp_user_id'] = $last_id;
            }

            header('Location: create_user_profile.php');
        }
    }
} catch (\Exception $e) {
    // echo 'Oops, we ran into an issue! ' . $e->getMessage();
    clearSessions();
    $_SESSION['login_failure'] = 'Invalid username or password';
    header('Location: login.php');
}
