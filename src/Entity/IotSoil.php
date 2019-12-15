<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IotSoilRepository")
 * @ORM\Table(indexes={@ORM\Index(name="soil__chipid", columns={"chipid"})})
 */
class IotSoil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $humidity;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $temperature;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $soil_humidity_raw;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chipid;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $free_memory;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    public function setHumidity(?float $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(?float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getSoilHumidityRaw(): ?float
    {
        return $this->soil_humidity_raw;
    }

    public function setSoilHumidityRaw(?float $soil_humidity_raw): self
    {
        $this->soil_humidity_raw = $soil_humidity_raw;

        return $this;
    }

    public function getChipid(): ?string
    {
        return $this->chipid;
    }

    public function setChipid(string $chipid): self
    {
        $this->chipid = $chipid;

        return $this;
    }

    public function getFreeMemory(): ?float
    {
        return $this->free_memory;
    }

    public function setFreeMemory(?float $free_memory): self
    {
        $this->free_memory = $free_memory;

        return $this;
    }

    public function getCreatedAt(): ?\Datetime
    {
        return $this->created_at;
    }
}
