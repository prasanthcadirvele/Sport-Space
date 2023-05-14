<?php

class User
{
    private string $nom;
    private string $prenom;
    private string $adresse_mail;
    private int $age;
    private string $numero_telephone;
    private string $username;
    private string $password;

    /**
     * @param $nom
     * @param $prenom
     * @param $adresse_mail
     * @param $age
     * @param $numero_telephone
     * @param $username
     * @param $password
     */
    public function __construct($nom, $prenom, $adresse_mail, $age, $numero_telephone, $username, $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse_mail = $adresse_mail;
        $this->age = $age;
        $this->numero_telephone = $numero_telephone;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAdresseMail()
    {
        return $this->adresse_mail;
    }

    /**
     * @param mixed $adresse_mail
     */
    public function setAdresseMail($adresse_mail)
    {
        $this->adresse_mail = $adresse_mail;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }

    /**
     * @param mixed $numero_telephone
     */
    public function setNumeroTelephone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }




}