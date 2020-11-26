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
    private $bus;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("gpu")
     */
    private $memory;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("gpu")
     */
    private $release_date;

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

    public function getReleaseDate(): ?string
    {
        return $this->release_date;
    }

    public function setReleaseDate(?string $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }
}
