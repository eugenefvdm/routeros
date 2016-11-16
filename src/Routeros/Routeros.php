<?php

namespace Routeros;

class Routeros
{
    
    private $api;

    public $ip_address;
    private $api_user, $api_password;

    public $command;

    function __construct($ip_address = '154.119.54.254', $username = 'api', $password = 'test') {
        $this->api = new Api();
        $this->ip_address = $ip_address;
        $this->username = $username;
        $this->password = $password;
    }

    public static function test()
    {

        $API = new Api();

        $API->debug = true;

        if ($API->connect('154.119.54.254', 'api', 'test')) {
            $API->write('/interface/getall');
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);
            print_r($ARRAY);
            $API->disconnect();
        }

    }

    public function queue()
    {
        $this->command .= "/queue";
        return $this;
    }

    public function simple() {
        $this->command .= "/simple";
        return $this;
    }

    public function pr() {
        $this->command .= "/print";
        $array = [];
        if ($this->api->connect($this->ip_address, $this->username, $this->password)) {
            $this->api->write($this->command);
            $READ = $this->api->read(false);
            $array = $this->api->parseResponse($READ);
            $this->api->disconnect();
        }
        return $array;
    }

    public function debug() {
        $this->api->debug = true;
    }

    public function credentials()
    {
        $credentials = [
            'ip_address' => $this->ip_address,
            'username' => $this->username,
            'password' => $this->password
        ];
        return json_encode($credentials);
    }

    public function router()
    {
        return $this;
    }

    public function ping($ip) {
        return Router::ping($ip);
    }

}