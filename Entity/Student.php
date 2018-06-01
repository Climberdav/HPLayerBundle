<?php

namespace Climberdav\HPLayerBundle\Entity;

/**
 * Class Student
 * Abstraction of ServiceWeb "Étudiants"
 * See @link(http://www.index-education.com/fr/ServiceWeb-Hyperplanning-Etudiants.php)
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Entity
 *
 */
class Student
{
    /**
     * @var \SoapClient $wsdlClient
     */
    protected $wsdlClient;

    /**
     * Clé
     * @var integer
     */
    private $key;

    /**
     * Nom
     * @var string
     */
    private $lastname;

    /**
     * Prénom
     * @var string
     */
    private $name;

    /**
     * Numéro d'Ordre
     * @var string
     */
    private $numeroDOrdre;

    /**
     * @var string
     */
    private $cas;

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var string
     */
    private $mail;

    /**
     * Student constructor.
     * @param Server $server
     */
    public function __construct(Server $server = null)
    {
        $this->wsdlClient = $server->connect();
    }

    /**
     * @return int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param int $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $surname
     */
    public function setLastname($surname)
    {
        $this->lastname = $surname;
    }

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
    public function getNumeroDOrdre()
    {
        return $this->numeroDOrdre;
    }

    /**
     * @param string $numeroDOrdre
     */
    public function setNumeroDOrdre($numeroDOrdre)
    {
        $this->numeroDOrdre = $numeroDOrdre;
    }

    /**
     * @return string
     */
    public function getCas()
    {
        return $this->cas;
    }

    /**
     * @param string $cas
     */
    public function setCas($cas)
    {
        $this->cas = $cas;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
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


}
