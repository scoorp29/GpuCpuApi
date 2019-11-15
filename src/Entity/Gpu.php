<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GpuRepository")
 */
class Gpu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("gpu")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("gpu")
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("gpu")
     */
    private $product_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $gpu_chip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $release_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("gpu")
     */
    private $release_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $bus;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("gpu")
     */
    private $memory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    private $memory_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $memory_bit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $gpu_clock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $memory_clock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("gpu")
     */
    private $shaders;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("gpu")
     */
    private $tmus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("gpu")
     */
    private $rops;

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

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getGpuChip(): ?string
    {
        return $this->gpu_chip;
    }

    public function setGpuChip(?string $gpu_chip): self
    {
        $this->gpu_chip = $gpu_chip;

        return $this;
    }

    public function getReleaseDate(): ?string
    {
        return $this->release_date;
    }

    public function setReleaseDate(?string $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->release_year;
    }

    public function setReleaseYear(?int $release_year): self
    {
        $this->release_year = $release_year;

        return $this;
    }

    public function getBus(): ?string
    {
        return $this->bus;
    }

    public function setBus(?string $bus): self
    {
        $this->bus = $bus;

        return $this;
    }

    public function getMemory(): ?string
    {
        return $this->memory;
    }

    public function setMemory(string $memory): self
    {
        $this->memory = $memory;

        return $this;
    }

    public function getMemoryType(): ?string
    {
        return $this->memory_type;
    }

    public function setMemoryType(?string $memory_type): self
    {
        $this->memory_type = $memory_type;

        return $this;
    }

    public function getMemoryBit(): ?string
    {
        return $this->memory_bit;
    }

    public function setMemoryBit(?string $memory_bit): self
    {
        $this->memory_bit = $memory_bit;

        return $this;
    }

    public function getGpuClock(): ?string
    {
        return $this->gpu_clock;
    }

    public function setGpuClock(string $gpu_clock): self
    {
        $this->gpu_clock = $gpu_clock;

        return $this;
    }

    public function getMemoryClock(): ?string
    {
        return $this->memory_clock;
    }

    public function setMemoryClock(?string $memory_clock): self
    {
        $this->memory_clock = $memory_clock;

        return $this;
    }

    public function getShaders(): ?int
    {
        return $this->shaders;
    }

    public function setShaders(?int $shaders): self
    {
        $this->shaders = $shaders;

        return $this;
    }

    public function getTmus(): ?int
    {
        return $this->tmus;
    }

    public function setTmus(?int $tmus): self
    {
        $this->tmus = $tmus;

        return $this;
    }

    public function getRops(): ?int
    {
        return $this->rops;
    }

    public function setRops(?int $rops): self
    {
        $this->rops = $rops;

        return $this;
    }
}
