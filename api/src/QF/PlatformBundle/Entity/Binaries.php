<?php

namespace QF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binaries
 *
 * @ORM\Table(name="api_binaries")
 * @ORM\Entity(repositoryClass="QF\PlatformBundle\Entity\BinariesRepository")
 */
class Binaries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="value", type="boolean")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateChosen", type="datetime")
     */
    private $dateChosen;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=512)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="QF\PlatformBundle\Entity\Track", inversedBy="datas")
     * @ORM\JoinColumn(nullable=true)
     */
    private $track;


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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return data
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateChosen
     *
     * @param \DateTime
     * @return data
     */
    public function setDateChosen($dateChosen)
    {
        $this->dateChosen = $dateChosen;

        return $this;
    }

    /**
     * Get dateChosen
     *
     * @return \DateTime $dateChosen
     */
    public function getDateChosen()
    {
        return $this->dateChosen;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return string
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set value
     *
     * @param boolean $value
     * @return binaries
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set track
     *
     * @param Track $track
     * @return Track
     */
    public function setTrack($track)
    {
        $this->track = $track;

        return $this;
    }

    /**
     * Get track
     *
     * @return Track
     */
    public function getTrack()
    {
        return $this->track;
    }
}
