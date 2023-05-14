<?php

class Sport 
{
    private int $sport_id;
    private string $nom_sport;

    /**
     * @param $sport_id
     * @param $nom_sport
     */
    public function __construct($sport_id, $nom_sport)
    {
        $this->sport_id = $sport_id;
        $this->nom_sport = $nom_sport;
    }

    /**
     * @return mixed
     */
    public function getSportId()
    {
        return $this->sport_id;
    }

    /**
     * @param mixed $sport_id
     */
    public function setSportId($sport_id)
    {
        $this->sport_id = $sport_id;
    }

    /**
     * @return mixed
     */
    public function getNomSport()
    {
        return $this->nom_sport;
    }

    /**
     * @param mixed $nom_sport
     */
    public function setNomSport($nom_sport)
    {
        $this->nom_sport = $nom_sport;
    }
}
