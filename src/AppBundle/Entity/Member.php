<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="members")
 */
class Member
{
    use Id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="20")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="20")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Choice({"m", "f"})
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="50")
     */
    private $birthPlace;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="255")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=12)
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="12")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="50")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=12)
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="12")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(max="255")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min="1", max="30")
     */
    private $currentRank;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank()
     * @Assert\Choice({"hobbies", "contest"})
     */
    private $practice;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(min="2", max="10")
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $medCertProvided;

//    private $medCertificate;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank()
     * @Assert\Choice({"approve", "decline"})
     */
    private $imageRight;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Choice({"es", "ch"})
     */
    private $payment;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $rulesDate;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $rulesAgree;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice({"jeune enfant", "enfant", "ado et adulte", "body karate"})
     */
    private $contribution;

    /**
     * @ORM\Column(type="text")
     */
    private $information;

    public function __construct()
    {
        $this->rulesDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * @param mixed $birthPlace
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCurrentRank()
    {
        return $this->currentRank;
    }

    /**
     * @param mixed $currentRank
     */
    public function setCurrentRank($currentRank)
    {
        $this->currentRank = $currentRank;
    }

    /**
     * @return mixed
     */
    public function getPractice()
    {
        return $this->practice;
    }

    /**
     * @param mixed $practice
     */
    public function setPractice($practice)
    {
        $this->practice = $practice;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getMedCertProvided()
    {
        return $this->medCertProvided;
    }

    /**
     * @param mixed $medCertProvided
     */
    public function setMedCertProvided($medCertProvided)
    {
        $this->medCertProvided = $medCertProvided;
    }

    /**
     * @return mixed
     */
    public function getImageRight()
    {
        return $this->imageRight;
    }

    /**
     * @param mixed $imageRight
     */
    public function setImageRight($imageRight)
    {
        $this->imageRight = $imageRight;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getRulesDate()
    {
        return $this->rulesDate;
    }

    /**
     * @param mixed $rulesDate
     */
    public function setRulesDate($rulesDate)
    {
        $this->rulesDate = $rulesDate;
    }

    /**
     * @return mixed
     */
    public function getRulesAgree()
    {
        return $this->rulesAgree;
    }

    /**
     * @param mixed $rulesAgree
     */
    public function setRulesAgree($rulesAgree)
    {
        $this->rulesAgree = $rulesAgree;
    }

    /**
     * @return mixed
     */
    public function getContribution()
    {
        return $this->contribution;
    }

    /**
     * @param mixed $contribution
     */
    public function setContribution($contribution)
    {
        $this->contribution = $contribution;
    }

    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param mixed $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }
}