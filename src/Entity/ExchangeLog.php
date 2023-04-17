<?php

namespace App\Entity;

use App\Repository\ExchangeLogRepository;
use Doctrine\ORM\Mapping as ORM;

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
}
