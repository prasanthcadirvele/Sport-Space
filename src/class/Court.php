<?php

class Court {
    private int $id;
    private Sport $sport;
    private Center $center;
    private float $prix_unitaire_par_heure;

    /**
     * @param $id
     * @param $sport
     * @param $center
     * @param $prix_unitaire_par_heure
     */
    public function __construct($id, $sport, $center, $prix_unitaire_par_heure)
    {
        $this->id = $id;
        $this->sport = $sport;
        $this->center = $center;
        $this->prix_unitaire_par_heure = $prix_unitaire_par_heure;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
    }

    /**
     * @return Center
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * @param Center $center
     */
    public function setCenter($center)
    {
        $this->center = $center;
    }

    /**
     * @return mixed
     */
    public function getPrixUnitaireParHeure()
    {
        return $this->prix_unitaire_par_heure;
    }

    /**
     * @param mixed $prix_unitaire_par_heure
     */
    public function setPrixUnitaireParHeure($prix_unitaire_par_heure)
    {
        $this->prix_unitaire_par_heure = $prix_unitaire_par_heure;
    }

}