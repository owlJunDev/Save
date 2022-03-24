<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RequestRepository::class)
 */
class Request
{
    const STATUS_NEW = 0;
    const STATUS_IN_PROCES = 1;
    const STATUS_END = 2;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MaterialV2::class, inversedBy="requests")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="requests")
     */
    private $project;

    /**
     * @ORM\Column(type="integer")
     */
    private $status = self::STATUS_NEW;

    /**
     * @ORM\ManyToOne(targetEntity=SupplierV2::class, inversedBy="requests")
     */
    private $supplier;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\ManyToOne(targetEntity=InvoiceV2::class, inversedBy="requests")
     */
    private $invoice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterial(): ?MaterialV2
    {
        return $this->material;
    }

    public function setMaterial(?MaterialV2 $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSupplier(): ?SupplierV2
    {
        return $this->supplier;
    }

    public function setSupplier(?SupplierV2 $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getInvoice(): ?InvoiceV2
    {
        return $this->invoice;
    }

    public function setInvoice(?InvoiceV2 $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
