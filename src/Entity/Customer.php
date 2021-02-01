<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\CustomerSearch;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"customer:read"}},
 *  collectionOperations={"get", "post", "search": {
 *      "method":"GET",
 *      "path":"/customers/search",
 *      "controller":CustomerSearch::class,
 *      "pagination_enabled": false,
 *      "normalization_context": {"groups":{"customer:search"}}
 *  }}
 * )
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"customer:read", "invoice:read", "customer:search"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "invoice:read", "customer:search"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "invoice:read", "customer:search"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customer:read", "invoice:read", "customer:search"})
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="customer")
     * @Groups("customer:read")
     */
    private $invoices;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setCustomer($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getCustomer() === $this) {
                $invoice->setCustomer(null);
            }
        }

        return $this;
    }
}
