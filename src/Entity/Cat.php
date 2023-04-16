<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatRepository::class)]
#[ApiResource]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gender $gender = null;

    #[ORM\OneToMany(mappedBy: 'Cat', targetEntity: FeedingTime::class, orphanRemoval: true)]
    private Collection $feedingTimes;

    public function __construct()
    {
        $this->feedingTimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, FeedingTime>
     */
    public function getFeedingTimes(): Collection
    {
        return $this->feedingTimes;
    }

    public function addFeedingTime(FeedingTime $feedingTime): self
    {
        if (!$this->feedingTimes->contains($feedingTime)) {
            $this->feedingTimes->add($feedingTime);
            $feedingTime->setCat($this);
        }

        return $this;
    }

    public function removeFeedingTime(FeedingTime $feedingTime): self
    {
        if ($this->feedingTimes->removeElement($feedingTime)) {
            // set the owning side to null (unless already changed)
            if ($feedingTime->getCat() === $this) {
                $feedingTime->setCat(null);
            }
        }

        return $this;
    }
}
