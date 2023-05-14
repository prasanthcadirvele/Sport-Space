<?php

class Reservation {
    private User $user;
    private Court $court;
    private $reservation_debut;
    private mixed $reservation_fin;
    private $nombre_de_personnes;

    /**
     * @param $user
     * @param $court
     * @param $reservation_debut
     * @param $reservation_fin
     * @param $nombre_de_personnes
     */
    public function __construct($user, $court, $reservation_debut, $reservation_fin, $nombre_de_personnes)
    {
        $this->user = $user;
        $this->court = $court;
        $this->reservation_debut = $reservation_debut;
        $this->reservation_fin = $reservation_fin;
        $this->nombre_de_personnes = $nombre_de_personnes;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCourt()
    {
        return $this->court;
    }

    /**
     * @param mixed $court
     */
    public function setCourt($court)
    {
        $this->court = $court;
    }

    /**
     * @return mixed
     */
    public function getReservationDebut()
    {
        return $this->reservation_debut;
    }

    /**
     * @param mixed $reservation_debut
     */
    public function setReservationDebut($reservation_debut)
    {
        $this->reservation_debut = $reservation_debut;
    }

    /**
     * @return mixed
     */
    public function getReservationFin()
    {
        return $this->reservation_fin;
    }

    /**
     * @param mixed $reservation_fin
     */
    public function setReservationFin($reservation_fin)
    {
        $this->reservation_fin = $reservation_fin;
    }

    /**
     * @return mixed
     */
    public function getNombreDePersonnes()
    {
        return $this->nombre_de_personnes;
    }

    /**
     * @param mixed $nombre_de_personnes
     */
    public function setNombreDePersonnes($nombre_de_personnes)
    {
        $this->nombre_de_personnes = $nombre_de_personnes;
    }


}