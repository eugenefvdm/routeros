<?php

namespace Routeros;

use Helpers\Helpers;

class Routeros
{

    public $resources;

    private $api;

    public $ip_address;

    private $username, $password;

    public $command;

    function __construct($ip_address = "", $username = "", $password = "") {
        $this->api = new Api();
        if (!$ip_address) {
            $config = Helpers::Config('demo');
            $this->ip_address = $config['ip_address'];
            $this->username = $config['username'];
            $this->password = $config['password'];
        } else {
            $this->ip_address = $ip_address;
            $this->username = $username;
            $this->password = $password;
        }
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

    public function queue()
    {
        $this->command .= "/queue";
        return $this;
    }

    public function simple() {
        $this->command .= "/simple";
        return $this;
    }

    public static function test()
    {

        $API = new Api();

        $API->debug = true;

        $config = Helpers::Config('nas');
        //die(print_r($config,1));

        if ($API->connect($config['ip_address'], $config['username'], $config['password'])) {
            $API->write('/interface/getall');
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);
            print_r($ARRAY);
            $API->disconnect();
        }

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

    public function version() {
        return $this->resource('version');
    }

    public function uptime() {
        return $this->resource('uptime');
    }

    public function resource($resource)
    {
        if ($this->resources) {
            return $this->resources[0][$resource];
        }
        $this->resources = $this->command('/system/resource/print');
        return $this->resources[0][$resource];
    }

    private function command($command)
    {
        $array = [];
        if ($this->api->connect($this->ip_address, $this->username, $this->password)) {
            $this->api->write($command);
            $READ = $this->api->read(false);
            $array = $this->api->parseResponse($READ);
            $this->api->disconnect();
        }
        return $array;
    }

    public function add($command, $args)
    {
        if ($this->api->connect($this->ip_address, $this->username, $this->password)) {
            $this->api->comm($command, $args);
            $this->api->disconnect();
        }
    }

}