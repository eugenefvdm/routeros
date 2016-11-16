<?php

namespace Routeros;

class Routeros
{
    private $api;

    private $router, $api_user, $api_password;

    public $command;

    function __construct($router = '154.119.54.254', $api_user = 'api', $api_password = 'test') {
        $this->api = new Api();
        $this->router = $router;
        $this->api_user = $api_user;
        $this->api_password = $api_password;
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
        if ($this->api->connect($this->router, $this->api_user, $this->api_password)) {
            $this->api->write($this->command);
            $READ = $this->api->read(false);
            $ARRAY = $this->api->parseResponse($READ);
            //print_r($ARRAY);
            $this->api->disconnect();
        }
//        return $this;
        return $ARRAY;
    }

    public function debug() {
        $this->api->debug = true;
    }

    public function credentials()
    {
        $credentials = [
            'router' => $this->router,
            'api_user' => $this->api_user,
            'api_password' => $this->api_password
        ];
        return json_encode($credentials);
    }

    public function router()
    {
        return $this;
    }

    public function ping() {
        return Router::ping($this->ip);
    }

}