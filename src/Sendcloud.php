<?php
/**
 * Created by PhpStorm.
 * User: chenmingming
 * Date: 2017/4/7
 * Time: 16:42
 */

namespace sendcloud;

use GuzzleHttp\Client;
use mmapi\api\ApiException;

class Sendcloud
{
    const COMMNON_URL = 'http://api.sendcloud.net/apiv2/mail/send';
    private $options = [
        'api_user' => null,
        'api_key'  => null,
        'client'   => [],
    ];

    public function __construct($options)
    {
        $this->options = array_replace($this->options, $options);
    }

    public function send(Mail $mail)
    {
        $client = new Client($this->options['client']);
        $rs     = $client->post(self::COMMNON_URL, [
                'form_params' => array_merge(
                    [
                        'apiUser' => $this->options['api_user'],
                        'apiKey'  => $this->options['api_key'],
                    ],
                    $mail->jsonSerialize()
                ),
            ]
        );

        $json   = $rs->getBody()
            ->getContents();
        $result = json_decode($json, true);

        if (!$result['result']) {
            throw new ApiException($result['message'], $result['statusCode']);
        }

    }
}