<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarsRepository")
 */
class Cars
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $date_circulation;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carburant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $boite_vitesse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_portes;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_places;

    /**
     * @ORM\Column(type="integer")
     */
    private $puissance_fiscale;

    /**
     * @ORM\Column(type="integer")
     */
    private $puissance_din;

    /**
     * @ORM\Column(type="boolean")
     */
    private $permis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateCirculation(): ?\DateTimeInterface
    {
        return $this->date_circulation;
    }

    public function setDateCirculation(\DateTimeInterface $date_circulation): self
    {
        $this->date_circulation = $date_circulation;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getBoiteVitesse(): ?string
    {
        return $this->boite_vitesse;
    }

    public function setBoiteVitesse(string $boite_vitesse): self
    {
        $this->boite_vitesse = $boite_vitesse;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getNombrePortes(): ?int
    {
        return $this->nombre_portes;
    }

    public function setNombrePortes(int $nombre_portes): self
    {
        $this->nombre_portes = $nombre_portes;

        return $this;
    }

    public function getNombrePlaces(): ?int
    {
        return $this->nombre_places;
    }

    public function setNombrePlaces(int $nombre_places): self
    {
        $this->nombre_places = $nombre_places;

        return $this;
    }

    public function getPuissanceFiscale(): ?int
    {
        return $this->puissance_fiscale;
    }

    public function setPuissanceFiscale(int $puissance_fiscale): self
    {
        $this->puissance_fiscale = $puissance_fiscale;

        return $this;
    }

    public function getPuissanceDin(): ?int
    {
        return $this->puissance_din;
    }

    public function setPuissanceDin(int $puissance_din): self
    {
        $this->puissance_din = $puissance_din;

        return $this;
    }

    public function getPermis(): ?bool
    {
        return $this->permis;
    }

    public function setPermis(bool $permis): self
    {
        $this->permis = $permis;

        return $this;
    }
}
