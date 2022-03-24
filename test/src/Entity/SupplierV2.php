<?php

namespace App\Entity;

use App\Repository\SupplierV2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierV2Repository::class)
 */
class SupplierV2
{

    const STATUS_INACTIVE = 0;
    const STATUS_CHECKED = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BLACK_LIST = 3;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_INACTIVE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleCompany;

    /**
     * @ORM\OneToMany(targetEntity=Request::class, mappedBy="supplier")
     */
    private $requests;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSecondname(): ?string
    {
        return $this->secondname;
    }

    public function setSecondname(string $secondname): self
    {
        $this->secondname = $secondname;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getItn(): ?string
    {
        return $this->itn;
    }

    public function setItn(string $itn): self
    {
        $this->itn = $itn;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTitleCompany(): ?string
    {
        return $this->titleCompany;
    }

    public function setTitleCompany(?string $titleCompany): self
    {
        $this->titleCompany = $titleCompany;

        return $this;
    }

    public function getLastNameWithInitials()
    {
        $firstName = mb_substr($this->getFirstname(), 0, 1) ? mb_substr($this->getFirstname(), 0, 1) . '.' : '';
        $secondname = mb_substr($this->getSecondname(), 0, 1) ? mb_substr($this->getSecondname(), 0, 1) : '';
        return sprintf('%s %s', $this->getLastname(), $firstName, $secondname);
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Request $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setSupplier($this);
        }

        return $this;
    }

    public function removeRequest(Request $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getSupplier() === $this) {
                $request->setSupplier(null);
            }
        }

        return $this;
    }
}
