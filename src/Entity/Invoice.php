<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InvoiceRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups":"invoice:read"}
 * )
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"invoice:read", "customer:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"invoice:read", "customer:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"invoice:read", "customer:read"})
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"invoice:read", "customer:read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
     * @Groups({"invoice:read"})
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
