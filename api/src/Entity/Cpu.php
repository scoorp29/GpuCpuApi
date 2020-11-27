<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CpuRepository")
 */
class Cpu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("cpu")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("cpu")
     */
    private $company;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("cpu")
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $code_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $cores;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $clock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $socket;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $process;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $l3_cache;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $tdp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("cpu")
     */
    private $released;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->code_name;
    }

    public function setCodeName(?string $code_name): self
    {
        $this->code_name = $code_name;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getCores(): ?string
    {
        return $this->cores;
    }

    public function setCores(?string $cores): self
    {
        $this->cores = $cores;

        return $this;
    }

    public function getClock(): ?string
    {
        return $this->clock;
    }

    public function setClock(?string $clock): self
    {
        $this->clock = $clock;

        return $this;
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    public function setSocket(?string $socket): self
    {
        $this->socket = $socket;

        return $this;
    }

    public function getProcess(): ?string
    {
        return $this->process;
    }

    public function setProcess(?string $process): self
    {
        $this->process = $process;

        return $this;
    }

    public function getL3Cache(): ?string
    {
        return $this->l3_cache;
    }

    public function setL3Cache(?string $l3_cache): self
    {
        $this->l3_cache = $l3_cache;

        return $this;
    }

    public function getTdp(): ?string
    {
        return $this->tdp;
    }

    public function setTdp(?string $tdp): self
    {
        $this->tdp = $tdp;

        return $this;
    }

    public function getReleased(): ?string
    {
        return $this->released;
    }

    public function setReleased(?string $released): self
    {
        $this->released = $released;

        return $this;
    }
}
