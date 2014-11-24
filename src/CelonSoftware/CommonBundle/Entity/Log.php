<?php

namespace CelonSoftware\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="CelonSoftware\CommonBundle\Entity\Repository\LogRepository")
 */
class Log {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="logdate", type="datetime", nullable=false)
     */
    private $logdate;

    /**
     * @ORM\Column(name="logip", type="string", length=17, nullable=false)
     */
    private $logdip;

    /**
     * @ORM\Column(name="logurl", type="string", length=255, nullable=false)
     */
    private $logurl;

    /**
     * @ORM\Column(name="logcode", type="string", length=500, nullable=false)
     */
    private $logcode;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set logdate
     *
     * @param \DateTime $logdate
     * @return Log
     */
    public function setLogdate($logdate)
    {
        $this->logdate = $logdate;

        return $this;
    }

    /**
     * Get logdate
     *
     * @return \DateTime 
     */
    public function getLogdate()
    {
        return $this->logdate;
    }

    /**
     * Set logdip
     *
     * @param string $logdip
     * @return Log
     */
    public function setLogdip($logdip)
    {
        $this->logdip = $logdip;

        return $this;
    }

    /**
     * Get logdip
     *
     * @return string 
     */
    public function getLogdip()
    {
        return $this->logdip;
    }

    /**
     * Set logurl
     *
     * @param string $logurl
     * @return Log
     */
    public function setLogurl($logurl)
    {
        $this->logurl = $logurl;

        return $this;
    }

    /**
     * Get logurl
     *
     * @return string 
     */
    public function getLogurl()
    {
        return $this->logurl;
    }

    /**
     * Set logcode
     *
     * @param string $logcode
     * @return Log
     */
    public function setLogcode($logcode)
    {
        $this->logcode = $logcode;

        return $this;
    }

    /**
     * Get logcode
     *
     * @return string 
     */
    public function getLogcode()
    {
        return $this->logcode;
    }
}
