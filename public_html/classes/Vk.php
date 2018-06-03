<?php
namespace classes;

/**
 * Description of Vk
 *
 * @author zlexus
 */
class Vk
{

    private $app_id = APP_ID;
    private $app_secret = APP_SECRET;
    private $url = URL . '/login.php';

    public function getToken($code)
    {
        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id=' . $this->app_id . '&redirect_uri=' . $this->url . '&client_secret=' . $this->app_secret . '&code=' . $code . '&v=5.52'), true);
       
        return $token;
    }

    public function getData($token)
    {
        $data = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id=' . $token['user_id'] . '&access_token=' . $token['access_token'] . '&fields=uid,first_name,last_name,&v=5.52'), true);
        $data_arr = $data['response'][0];
        return $data_arr;
    }
}
