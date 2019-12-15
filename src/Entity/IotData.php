<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IotDataRepository")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="iotdata__chipid", columns={"chipid"}),
 *     @ORM\Index(name="iotdata__datatype", columns={"value_type"}),
 * })
 */
class IotData
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
    private $valueType;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

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

    public function getValueType(): ?string
    {
        return $this->valueType;
    }

    public function setValueType(string $valueType): self
    {
        $this->valueType = $valueType;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;

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
