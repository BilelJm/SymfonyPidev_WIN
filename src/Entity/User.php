<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email",
 *     message="l'email que vous avez indequé est deja utilisé!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank (message="le surnom est obligatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @Assert\NotBlank (message="l'email est obligatoire")
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;


    /**
     *
     * @ORM\Column(type="string", length=255, nullable=true)

     */
    private $Tel;

    /**
     * @Assert\NotBlank (message="le prenom est obligatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @Assert\NotBlank (message="le nom est obligatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;


    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit etre minimum 8 caracteres")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $roles = "ROLE_USER" ;

    /**
     * @ORM\Column(type="boolean" , nullable=true)
     */
    private $banned = false;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reset_token;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $githubId;

    /**
     * @ORM\OneToMany(targetEntity=Programme::class, mappedBy="user")
     */
    private $programmes;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="user")
     */
    private $annoces;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="user")
     */
    private $Comments;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="user")
     */
    private $promotions;

    /**
     * @ORM\OneToMany(targetEntity=OptionGuide::class, mappedBy="user")
     */
    private $guides;

    /**
     * @ORM\OneToMany(targetEntity=OptionTransport::class, mappedBy="user")
     */
    private $transports;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="user")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="user")
     */
    private $bookings;



    public function __construct()
    {
        $this->programmes = new ArrayCollection();
        $this->annoces = new ArrayCollection();
        $this->Comments = new ArrayCollection();
        $this->promotions = new ArrayCollection();
        $this->guides = new ArrayCollection();
        $this->transports = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }



    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles = "ROLE_USER";

        return [$roles];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }

    public function getGithubId(): ?string
    {
        return $this->githubId;
    }

    public function setGithubId(?string $githubId): self
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return Collection|Programme[]
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->setUser($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getUser() === $this) {
                $programme->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnoces(): Collection
    {
        return $this->annoces;
    }

    public function addAnnoce(Annonce $annoce): self
    {
        if (!$this->annoces->contains($annoce)) {
            $this->annoces[] = $annoce;
            $annoce->setUser($this);
        }

        return $this;
    }

    public function removeAnnoce(Annonce $annoce): self
    {
        if ($this->annoces->removeElement($annoce)) {
            // set the owning side to null (unless already changed)
            if ($annoce->getUser() === $this) {
                $annoce->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->Comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->Comments->contains($comment)) {
            $this->Comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->Comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setUser($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getUser() === $this) {
                $promotion->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OptionGuide>
     */
    public function getGuides(): Collection
    {
        return $this->guides;
    }

    public function addGuide(OptionGuide $guide): self
    {
        if (!$this->guides->contains($guide)) {
            $this->guides[] = $guide;
            $guide->setUser($this);
        }

        return $this;
    }

    public function removeGuide(OptionGuide $guide): self
    {
        if ($this->guides->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getUser() === $this) {
                $guide->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OptionTransport>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(OptionTransport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setUser($this);
        }

        return $this;
    }

    public function removeTransport(OptionTransport $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getUser() === $this) {
                $transport->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setUser($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getUser() === $this) {
                $booking->setUser(null);
            }
        }

        return $this;
    }










}
