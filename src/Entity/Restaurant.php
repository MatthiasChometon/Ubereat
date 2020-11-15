<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Dish::class, mappedBy="restaurant")
     */
    private $dish;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, inversedBy="restaurants")
     */
    private $RestaurantOrder;

    public function __construct()
    {
        $this->dish = new ArrayCollection();
        $this->RestaurantOrder = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Dish[]
     */
    public function getDish(): Collection
    {
        return $this->dish;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dish->contains($dish)) {
            $this->dish[] = $dish;
            $dish->setRestaurant($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dish->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getRestaurant() === $this) {
                $dish->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getRestaurantOrder(): Collection
    {
        return $this->RestaurantOrder;
    }

    public function addRestaurantOrder(Order $restaurantOrder): self
    {
        if (!$this->RestaurantOrder->contains($restaurantOrder)) {
            $this->RestaurantOrder[] = $restaurantOrder;
        }

        return $this;
    }

    public function removeRestaurantOrder(Order $restaurantOrder): self
    {
        $this->RestaurantOrder->removeElement($restaurantOrder);

        return $this;
    }
}
