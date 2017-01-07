<?php

namespace UserBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @var string
     */
    private $biography;

    /**
     * @var string
     */
    private $signatureDish;

    /**
     * @var float
     */
    private $rating;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $level;

    /**
     * @var integer
     */
    private $participation;

    /**
     * @var string
     */
    private $profession;


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set biography
     *
     * @param string $biography
     *
     * @return User
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set signatureDish
     *
     * @param string $signatureDish
     *
     * @return User
     */
    public function setSignatureDish($signatureDish)
    {
        $this->signatureDish = $signatureDish;

        return $this;
    }

    /**
     * Get signatureDish
     *
     * @return string
     */
    public function getSignatureDish()
    {
        return $this->signatureDish;
    }

    /**
     * Set rating
     *
     * @param float $rating
     *
     * @return User
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return User
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set participation
     *
     * @param integer $participation
     *
     * @return User
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return integer
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return User
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $baptismsHasUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $payments;


    /**
     * Add baptismsHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismsHasUser
     *
     * @return User
     */
    public function addBaptismsHasUser(\AppBundle\Entity\BaptismHasUser $baptismsHasUser)
    {
        $this->baptismsHasUser[] = $baptismsHasUser;

        return $this;
    }

    /**
     * Remove baptismsHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismsHasUser
     */
    public function removeBaptismsHasUser(\AppBundle\Entity\BaptismHasUser $baptismsHasUser)
    {
        $this->baptismsHasUser->removeElement($baptismsHasUser);
    }

    /**
     * Get baptismsHasUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaptismsHasUser()
    {
        return $this->baptismsHasUser;
    }

    /**
     * Add payment
     *
     * @param \AppBundle\Entity\Payment $payment
     *
     * @return User
     */
    public function addPayment(\AppBundle\Entity\Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \AppBundle\Entity\Payment $payment
     */
    public function removePayment(\AppBundle\Entity\Payment $payment)
    {
        $this->payments->removeElement($payment);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $medias;


    /**
     * Add media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return User
     */
    public function addMedia(\AppBundle\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \AppBundle\Entity\Media $media
     */
    public function removeMedia(\AppBundle\Entity\Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $restaurants;


    /**
     * Add restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return User
     */
    public function addRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants[] = $restaurant;

        return $this;
    }

    /**
     * Remove restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     */
    public function removeRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants->removeElement($restaurant);
    }

    /**
     * Get restaurants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }
}
