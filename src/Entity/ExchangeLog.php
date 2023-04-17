<?php

namespace App\Entity;

use App\Repository\ExchangeLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: ExchangeLogRepository::class)]
class ExchangeLog
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $old_amount = null;

    #[ORM\Column(length: 15)]
    private ?string $old_currency = null;

    #[ORM\Column]
    private ?float $new_amount = null;

    #[ORM\Column(length: 15)]
    private ?string $new_currency = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column]
    private ?\DateTime $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldAmount(): ?float
    {
        return $this->old_amount;
    }

    public function setOldAmount(float $old_amount): self
    {
        $this->old_amount = $old_amount;

        return $this;
    }

    public function getOldCurrency(): ?string
    {
        return $this->old_currency;
    }

    public function setOldCurrency(string $old_currency): self
    {
        $this->old_currency = $old_currency;

        return $this;
    }

    public function getNewAmount(): ?float
    {
        return $this->new_amount;
    }

    public function setNewAmount(float $new_amount): self
    {
        $this->new_amount = $new_amount;

        return $this;
    }

    public function getNewCurrency(): ?string
    {
        return $this->new_currency;
    }

    public function setNewCurrency(string $new_currency): self
    {
        $this->new_currency = $new_currency;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
