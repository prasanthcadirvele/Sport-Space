<?php

namespace config;

class DatabaseConfiguration
{
    private $host;
    private $dbname;
    private $username;
    private $password;

    /**
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     */
    public function __construct()
    {
        $this->host = "db4free.net";
        $this->dbname = "sports_court_28";
        $this->username = "sport_court_28";
        $this->password = "password";
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

}