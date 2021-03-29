<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;


/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo extends Media
{
    /**
     * @ORM\Column(type="array")
     */
    private ArrayCollection $thumbnails;

    public function __construct()
    {
        $this->thumbnails = new ArrayCollection();
    }

    /**
     * @return Collection|Photo[]
     */
    public function getThumbnails(): Collection
    {
        return $this->thumbnails;
    }

    public function addThumbnail(string $thumbnail): self
    {
        if (!$this->thumbnails->contains($thumbnail)) {
            $this->thumbnails[] = $thumbnail;
        }

        return $this;
    }

    public function removeThumbnail(string $thumbnail): self
    {
        $this->thumbnails->removeElement($thumbnail);
        return $this;
    }
}
