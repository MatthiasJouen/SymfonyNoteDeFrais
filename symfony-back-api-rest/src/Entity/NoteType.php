<?php

namespace App\Entity;

use App\Repository\NoteTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteTypeRepository::class)]
#[ApiResource()]
class NoteType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'note_type', targetEntity: NoteFrais::class)]
    private Collection $noteFrais;

    public function __construct()
    {
        $this->noteFrais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, NoteFrais>
     */
    public function getNoteFrais(): Collection
    {
        return $this->noteFrais;
    }

    public function addNoteFrai(NoteFrais $noteFrai): static
    {
        if (!$this->noteFrais->contains($noteFrai)) {
            $this->noteFrais->add($noteFrai);
            $noteFrai->setNoteType($this);
        }

        return $this;
    }

    public function removeNoteFrai(NoteFrais $noteFrai): static
    {
        if ($this->noteFrais->removeElement($noteFrai)) {
            // set the owning side to null (unless already changed)
            if ($noteFrai->getNoteType() === $this) {
                $noteFrai->setNoteType(null);
            }
        }

        return $this;
    }
}
