<?php

namespace Climberdav\HPLayerBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Server Entity
 *
 * @author Davdi Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Entity
 *
 * @ORM\Table(name="hyperplanning_server")
 * @ORM\Entity(repositoryClass="Climberdav\HPLayerBundle\Entity\Repository\ServerRepository")
 * @UniqueEntity(fields={"ip", "root"})
 */
class Server
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     * @Assert\Ip()
     * @ORM\Column(name="host_ip", type="string")
     */
    private $ip;

    /**
     * @var integer
     * @ORM\Column(name="host_port", type="integer")
     */
    private $port = '8080';

    /**
     * @var string
     * @ORM\Column(name="wsdl_root", type="string")
     */
    private $root = 'hpsw';

    /**
     * @var string
     * @var string
     * @ORM\Column(name="wsdl_login", type="string")
     */
    private $login = 'WWWUSER';

    /**
     * @var string
     * @ORM\Column(name="wsdl_password", type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="protocol", type="string")
     */
    private $protocol = "https";

    /**
     * @var \DateTime
     * @ORM\Column(name="first_day_of_server", type="datetime")
     */
    private $firstDayOfServer;

    /**
     * @var boolean
     * @ORM\Column(name="disabled", type="boolean")
     */
    private $disabled = false;

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
     * Set name
     *
     * @param string $name
     *
     * @return Server
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Server
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return Server
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set root
     *
     * @param string $root
     *
     * @return Server
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Server
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Server
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set protocol
     *
     * @param string $protocol
     *
     * @return Server
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Get protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set firstDayOfServer
     *
     * @param \DateTime $firstDayOfServer
     *
     * @return Server
     */
    public function setFirstDayOfServer($firstDayOfServer)
    {
        $this->firstDayOfServer = $firstDayOfServer;

        return $this;
    }

    /**
     * Get firstDayOfServer
     *
     * @return \DateTime
     */
    public function getFirstDayOfServer()
    {
        return $this->firstDayOfServer;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return Server
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }
}
