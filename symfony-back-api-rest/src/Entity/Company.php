<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource()]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: NoteFrais::class)]
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
            $noteFrai->setCompany($this);
        }

        return $this;
    }

    public function removeNoteFrai(NoteFrais $noteFrai): static
    {
        if ($this->noteFrais->removeElement($noteFrai)) {
            // set the owning side to null (unless already changed)
            if ($noteFrai->getCompany() === $this) {
                $noteFrai->setCompany(null);
            }
        }

        return $this;
    }
}
