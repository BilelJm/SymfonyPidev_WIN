<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="le titre de proggramme est obligatoire")
     *  * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le titre ne doit pas contenir un chiffre")
     *   * @Assert\Length(
     *      min = 10,
     *      max = 15,
     *      minMessage = "Le titre doit contenir au moins {{ limit }} caractéres",
     *      maxMessage = "Le titre doit contenir au plus {{ limit }} characters"
     * )
     *
     */
    private $Titre;

    /**
     * @Assert\NotBlank (message="la description est obligatoire")
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 50,
     *      max = 100,
     *       minMessage = "La description doit contenir au moins {{ limit }} caractéres",
     *      maxMessage = "La description doit contenir au plus {{ limit }} characters"
     * )
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank (message="le prix est obligatoire")
     * @Assert\Range (min=10 , max=100 , notInRangeMessage = "Le prix doit etre entre {{ min }} et {{ max }} dt ",)
     * @Assert\Positive
     */
    private $prix;

    /**
     *  * @Assert\NotBlank (message="la date est obligatoire")
     * @ORM\Column(type="date")


     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="l'adresse est obligatoire")
     *  @Assert\Length(
     *      min = 10,
     *      max = 20,
     *       minMessage = "La adresse doit contenir au moins {{ limit }} caractéres",
     *      maxMessage = "La description doit contenir au plus {{ limit }} characters"
     * )
     */
    private $adresse;

    /**
     * @Assert\NotBlank (message="la category est obligatoire")
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="programmes")
     */
    private $category;









    /**
     * @ORM\ManyToOne(targetEntity=OptionGuide::class, inversedBy="programme")
     */
    private $Guide;

    /**
     * @ORM\ManyToOne(targetEntity=OptionTransport::class, inversedBy="programmes")
     */
    private $transport;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="programmes", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="programmes")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="programmes")
     */
    private $user;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

   
    public function getGuide(): ?OptionGuide
    {
        return $this->Guide;
    }

    public function setGuide(?OptionGuide $Guide): self
    {
        $this->Guide = $Guide;

        return $this;
    }

    public function getTransport(): ?OptionTransport
    {
        return $this->transport;
    }

    public function setTransport(?OptionTransport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProgrammes($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProgrammes() === $this) {
                $image->setProgrammes(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
