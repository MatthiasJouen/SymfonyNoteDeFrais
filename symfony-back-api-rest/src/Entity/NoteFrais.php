<?php

namespace App\Entity;

use App\Repository\NoteFraisRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteFraisRepository::class)]
#[ApiResource()]
class NoteFrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'noteFrais')]
    private ?User $user = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $save_date = null;

    #[ORM\ManyToOne(inversedBy: 'noteFrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NoteType $note_type = null;

    #[ORM\ManyToOne(inversedBy: 'noteFrais')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSaveDate(): ?\DateTimeInterface
    {
        return $this->save_date;
    }

    public function setSaveDate(\DateTimeInterface $save_date): static
    {
        $this->save_date = $save_date;

        return $this;
    }

    public function getNoteType(): ?NoteType
    {
        return $this->note_type;
    }

    public function setNoteType(?NoteType $note_type): static
    {
        $this->note_type = $note_type;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
