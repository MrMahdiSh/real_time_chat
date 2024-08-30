<?php

namespace App\Helper;

/**
 * Class InstagramBasicDisplay
 * @package EspressoDev\InstagramBasicDisplay
 */
class InstagramApiPhp
{
    const API_URL = 'https://graph.instagram.com/';

    const API_OAUTH_URL = 'https://api.instagram.com/oauth/authorize';

    const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';

    const API_TOKEN_EXCHANGE_URL = 'https://graph.instagram.com/access_token';

    const API_TOKEN_REFRESH_URL = 'https://graph.instagram.com/refresh_access_token';

    /**
     * @var string
     */
    private $_appId;

    /**
     * @var string
     */
    private $_appSecret;

    /**
     * @var string
     */
    private $_redirectUri;

    /**
     * @var string
     */
    private $_accesstoken;

    private $_user_id;

    /**
     * @var string[]
     */
    public $_scopes = ['user_profile', 'user_media'];

    /**
     * @var string
     */
    private $_userFields = 'account_type, id, media_count, username';

    /**
     * @var string
     */
    private $_mediaFields = 'caption, id, media_type, media_url, permalink, thumbnail_url, timestamp, username, children{id, media_type, media_url, permalink, thumbnail_url, timestamp, username}';

    /**
     * @var string
     */
    private $_mediaChildrenFields = 'id, media_type, media_url, permalink, thumbnail_url, timestamp, username';

    /**
     * @var int
     */
    private $_timeout = 90000;

    /**
     * @var int
     */
    private $_connectTimeout = 20000;

    /**
     * InstagramBasicDisplay constructor.
     * @param string[string]|string $config configuration parameters
     * @throws InstagramBasicDisplayException
     */
    public function __construct($config = null)
    {
        if (is_array($config)) {
            $this->setAppId($config['appId']);
            $this->setAppSecret($config['appSecret']);
            $this->setRedirectUri($config['redirectUri']);
            $this->setAccessToken($config['access_token']);


            if (isset($config['timeout'])) {
                $this->setTimeout($config['timeout']);
            }

            if (isset($config['connectTimeout'])) {
                $this->setConnectTimeout($config['connectTimeout']);
            }
        } elseif (is_string($config)) {
            // For read-only
            $this->setAccessToken($config);
        } else {
            throw new InstagramBasicDisplayException('Error: __construct() - Configuration data is missing.');
        }
    }

    /**
     * @param string[] $scopes
     * @param string $state
     * @return string
     * @throws InstagramBasicDisplayException
     */
    public function getLoginUrl($state = '')
    {
        //144/06/07 String Example https://api.instagram.com/oauth/authorize
        //  ?client_id=990602627938098
        //  &redirect_uri=https://socialsizzle.herokuapp.com/auth/
        //  &scope=user_profile,user_media
        //  &response_type=code

        if (count(array_intersect($this->_scopes, $this->_scopes)) === count($this->_scopes)) {
            return self::API_OAUTH_URL . '?client_id=' . $this->getAppId() . '&redirect_uri=' . urlencode($this->getRedirectUri()) . '&scope=' . implode(',',
                    $this->_scopes) . '&response_type=code' . ($state != '' ? '&state=' . $state : '');
        }

        throw new InstagramBasicDisplayException("Error: getLoginUrl() - The parameter isn't an array or invalid scope permissions used.");
    }


    public function mediaPosting($id = '0')
    {
        if ($id === '0') {
            $id = 'me';
        }

        $imageMediaObjectEndpoint = $id . '/media';

        $imageMediaObjectEndpointParams = array( // POST
            'image_url' => 'http://justinstolpe.com/sandbox/ig_publish_content_img.png',
            'caption' => 'This image was posted through the Instagram Graph API with a script I wrote! Go check out the video tutorial on my YouTube channel.
			.
			youtube.com/justinstolpe
			.
			#instagram #graphapi #instagramgraphapi #code #coding #programming #php #api #webdeveloper #codinglife #developer #coder #tech #developerlife #webdev #youtube #instgramgraphapi
		',
            'access_token' => $this->getAccessToken()
        );


        //$function, $params = null, $method = 'GET'
        $result = $this->_makeCall($imageMediaObjectEndpoint, $imageMediaObjectEndpointParams, 'POST');

        return $result;

        while ($imageMediaObjectStatusCode != 'FINISHED') { // keep checking media object until it is ready for publishing
            $imageMediaObjectStatusEndpoint = $ENDPOINT_BASE . $imageMediaObjectResponseArray['id'];
            $imageMediaObjectStatusEndpointParams = array( // endpoint params
                'fields' => 'status_code',
                'access_token' => $accessToken
            );
            $imageMediaObjectResponseArray = makeApiCall($imageMediaObjectStatusEndpoint, 'GET', $imageMediaObjectStatusEndpointParams);
            $imageMediaObjectStatusCode = $imageMediaObjectResponseArray['status_code'];
            sleep(5);
        }


    }


    /**
     * @param int $id
     * @return object
     * @throws InstagramBasicDisplayException
     */
    public function getUserProfile($id = 0)
    {
        if ($id === 0) {
            $id = 'me';
        }

        return $this->_makeCall($id, ['fields' => $this->_userFields]);
    }

    /**
     * @param string $id
     * @param int $limit
     * @param string|null $before
     * @param string|null $after
     * @return object
     * @throws InstagramBasicDisplayException
     */
    public function getUserMedia($id = 'me', $limit = 0, $before = null, $after = null)
    {
        $params = [
            'fields' => $this->_mediaFields
        ];

        if ($limit > 0) {
            $params['limit'] = $limit;
        }
        if (isset($before)) {
            $params['before'] = $before;
        }
        if (isset($after)) {
            $params['after'] = $after;
        }

        return $this->_makeCall($id . '/media', $params);
    }

    /**
     * @param string $id
     * @return object
     * @throws InstagramBasicDisplayException
     */
    public function getMedia($id)
    {
        return $this->_makeCall($id, ['fields' => $this->_mediaFields]);
    }

    /**
     * @param string $id
     * @return object
     * @throws InstagramBasicDisplayException
     */
    public function getMediaChildren($id)
    {
        return $this->_makeCall($id . '/children', ['fields' => $this->_mediaChildrenFields]);
    }

    /**
     * @param object $obj
     * @return object|null
     * @throws InstagramBasicDisplayException
     */
    public function pagination($obj)
    {
        if (is_object($obj) && !is_null($obj->paging)) {
            if (!isset($obj->paging->next)) {
                return null;
            }

            $apiCall = explode('?', $obj->paging->next);

            if (count($apiCall) < 2) {
                return null;
            }

            $function = str_replace(self::API_URL, '', $apiCall[0]);
            parse_str($apiCall[1], $params);

            // No need to include access token as this will be handled by _makeCall
            unset($params['access_token']);

            return $this->_makeCall($function, $params);
        }

        throw new InstagramBasicDisplayException("Error: pagination() | This method doesn't support pagination.");
    }

    /**
     * @param string $code
     * @param bool $tokenOnly
     * @return object|string
     * @throws InstagramBasicDisplayException
     */
    public function getOAuthToken($code, $tokenOnly = false)
    {
        $apiData = array(
            'client_id' => $this->getAppId(),
            'client_secret' => $this->getAppSecret(),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->getRedirectUri(),
            'code' => $code
        );

        $result = $this->_makeOAuthCall(self::API_OAUTH_TOKEN_URL, $apiData);

        return !$tokenOnly ? $result : $result->access_token;
    }

    /**
     * @param string $token
     * @param bool $tokenOnly
     * @return object|string
     * @throws InstagramBasicDisplayException
     */
    public function getLongLivedToken($token, $tokenOnly = false)
    {
        $apiData = array(
            'client_secret' => $this->getAppSecret(),
            'grant_type' => 'ig_exchange_token',
            'access_token' => $token
        );

        $result = $this->_makeOAuthCall(self::API_TOKEN_EXCHANGE_URL, $apiData, 'GET');

        return !$tokenOnly ? $result : $result->access_token;
    }

    /**
     * @param string $token
     * @param bool $tokenOnly
     * @return object|string
     * @throws InstagramBasicDisplayException
     */
    public function refreshToken($token, $tokenOnly = false)
    {
        $apiData = array(
            'grant_type' => 'ig_refresh_token',
            'access_token' => $token
        );

        $result = $this->_makeOAuthCall(self::API_TOKEN_REFRESH_URL, $apiData, 'GET');

        return !$tokenOnly ? $result : $result->access_token;
    }

    /**
     * @param string $function
     * @param string[]|null $params
     * @param string $method
     * @return object
     * @throws InstagramBasicDisplayException
     */
    protected function _makeCall($function, $params = null, $method = 'GET')
    {
        try {
            if (!isset($this->_accesstoken)) {
                throw new InstagramBasicDisplayException("Error: _makeCall() | $function - This method requires an authenticated users access token.");
            }

            $authMethod = '?access_token=' . $this->getAccessToken();

            $paramString = null;

            if (isset($params) && is_array($params)) {
                $paramString = '&' . http_build_query($params);
            }

            $apiCall = self::API_URL . $function . $authMethod . (('GET' === $method) ? $paramString : null);

            $headerData = array('Accept: application/json');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiCall);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $this->_connectTimeout);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->_timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, true);

            $jsonData = curl_exec($ch);

            if (!$jsonData) {
                throw new InstagramBasicDisplayException('Error: _makeCall() - cURL error: ' . curl_error($ch), curl_errno($ch));
            }

            list($headerContent, $jsonData) = explode("\r\n\r\n", $jsonData, 2);

            curl_close($ch);

            return json_decode($jsonData);
        } catch (\Exception $e) {
            return null;

        }
    }

    /**
     * @param string $apiHost
     * @param string[] $params
     * @param string $method
     * @return object
     * @throws InstagramBasicDisplayException
     */
    private function _makeOAuthCall($apiHost, $params, $method = 'POST')
    {
        $paramString = null;

        if (isset($params) && is_array($params)) {
            $paramString = '?' . http_build_query($params);
        }

        $apiCall = $apiHost . (('GET' === $method) ? $paramString : null);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCall);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->_timeout);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, count($params));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        $jsonData = curl_exec($ch);

        if (!$jsonData) {
            throw new InstagramBasicDisplayException('Error: _makeOAuthCall() - cURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($jsonData);
    }

    /**
     * @param string $token
     */


    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
    }

    public function getUserId($user_id)
    {
        return $this->_user_id;
    }


    public function setAccessToken($token)
    {
        $this->_accesstoken = $token;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accesstoken;
    }

    /**
     * @param string $appId
     */
    public function setAppId($appId)
    {
        $this->_appId = $appId;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->_appId;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret($appSecret)
    {
        $this->_appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->_appSecret;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri($redirectUri)
    {
        $this->_redirectUri = $redirectUri;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->_redirectUri;
    }

    /**
     * @param string $fields
     */
    public function setUserFields($fields)
    {
        $this->_userFields = $fields;
    }

    /**
     * @param string $fields
     */
    public function setMediaFields($fields)
    {
        $this->_mediaFields = $fields;
    }

    /**
     * @param string $fields
     */
    public function setMediaChildrenFields($fields)
    {
        $this->_mediaChildrenFields = $fields;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
    }

    /**
     * @param int $connectTimeout
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->_connectTimeout = $connectTimeout;
    }
}




//$instagram = new InstagramBasicDisplay([
//    'appId' => '1300107147088809',
//    'appSecret' => '2aa2966f68e191450fd2e0da483ac72a',
//    'redirectUri' => 'https://socialsizzle.herokuapp.com/auth/'
//]);


//Step 1  Login User And Get Permission And Code
//echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";

//Step 2 Set Code And Get Access Tokens
//$te = $instagram->getOAuthToken('AQCEUJ9-growcWmpGTlXaCt7S1IoXMJQynm7ymhFsyRJL0mkwGsHJa8TtPMA1PEj_FQuyWTF6Bfu3kvUrN0I_EkZz2DkFSiL1UJUjLZ0eUVerMOQd3I83EcwTnF4zAOwo295WouEmV_K_hxG5tbVPM18owy8xeO409Hh1rbAQl1zeUaXQmdyJ6Kx_1XJy74GZy-pm3qRJm1wkQA7I4xL-vqaZn9B3bdDAi0O7BbXeiw5aA');
//echo json_encode($te);


//Step 3 After Get AccessToken And UserId Set These
//$instagram->setAccessToken('IGQVJYRXFRSGxFQUZA2QnJ2S0E5SldfUWxMVVlsRjk2V3FuR0VVbm9JZAS02SlV6aEU2WURPa2ZAqb2lkWmswRFF6ZA255WnZAlNWVwMm5TTUVJS0plNVl4Qm1DQjA4dnlNdFpQbUVhSWdqbEtKQmxLYTM0ZAjY4YWg3RzU4bjFv');
//$instagram->setUserId('17841449159661776');

//echo  json_encode($instagram->getAccessToken());

///Get Users Media Ands ....

// getUserProfile
//$te = $instagram->getUserProfile();
//echo json_encode($te);


// getUserProfile
//$te = $instagram->getUserMedia();
//var_dump($te);


//Post A Media
//$te = $instagram->mediaPosting('4290622650974000');
//echo json_encode($te);
