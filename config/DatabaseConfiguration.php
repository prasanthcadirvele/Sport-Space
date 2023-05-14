<?php

namespace config;

class DatabaseConfiguration
{
    private $localhost;
    private $id20752598_sports_court_28;
    private $id20752598_sport_court_28;
    private $Password1@;

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