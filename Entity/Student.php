<?php

namespace ClimberdavHPLayerBundle\Entity;


use Symfony\Component\Validator\Constraints\DateTime;


class Student
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var DateTime $birth
     */
    private $birth;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param DateTime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @return int
     */
    public function getKeyHP()
    {
        return $this->keyHP;
    }

    /**
     * @param int $keyHP
     */
    public function setKeyHP($keyHP)
    {
        $this->keyHP = $keyHP;
    }

    /**
     * @return string
     */
    public function getCAS()
    {
        return $this->CAS;
    }

    /**
     * @param string $CAS
     */
    public function setCAS($CAS)
    {
        $this->CAS = $CAS;
    }

    /**
     * @var integer $keyHP
     */
    private $keyHP;

    /**
     * @var string
     */
    private $CAS;



}