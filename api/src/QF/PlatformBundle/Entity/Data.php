<?php

namespace QF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 *
 * @ORM\Table(name="api_data")
 * @ORM\Entity(repositoryClass="QF\PlatformBundle\Entity\dataRepository")
 */
abstract class Data
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
     * @return data
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
     * Set track
     *
     * @param Track $track
     * @return Data
     */
    public function setTrack($track)
    {
        $this->track = $track;

        return $this;
    }
}
