<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EditorRepository")
 */
class Editor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SocietyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nationality;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoGame", mappedBy="Editor")
     */
    private $videoGames;

    public function __construct()
    {
        $this->videoGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocietyName(): ?string
    {
        return $this->SocietyName;
    }

    public function setSocietyName(string $SocietyName): self
    {
        $this->SocietyName = $SocietyName;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(string $Nationality): self
    {
        $this->Nationality = $Nationality;

        return $this;
    }

    /**
     * @return Collection|VideoGame[]
     */
    public function getVideoGames(): Collection
    {
        return $this->videoGames;
    }

    public function addVideoGame(VideoGame $videoGame): self
    {
        if (!$this->videoGames->contains($videoGame)) {
            $this->videoGames[] = $videoGame;
            $videoGame->setEditor($this);
        }

        return $this;
    }

    public function removeVideoGame(VideoGame $videoGame): self
    {
        if ($this->videoGames->contains($videoGame)) {
            $this->videoGames->removeElement($videoGame);
            // set the owning side to null (unless already changed)
            if ($videoGame->getEditor() === $this) {
                $videoGame->setEditor(null);
            }
        }

        return $this;
    }
}
