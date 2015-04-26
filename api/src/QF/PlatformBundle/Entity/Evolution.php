<?php

namespace QF\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evolution
 *
 * @ORM\Table(name="api_evolution")
 * @ORM\Entity(repositoryClass="QF\PlatformBundle\Entity\EvolutionRepository")
 */
class Evolution
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
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=5, scale=2)
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
     * @ORM\Column(name="comment", type="string", length=512, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="QF\PlatformBundle\Entity\Proportion", inversedBy="evolutions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $proportion;

    /**
     * @ORM\ManyToOne(targetEntity="QF\PlatformBundle\Entity\Track", inversedBy="evolutions")
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
     * Set value
     *
     * @param string $value
     * @return evolution
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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

    /**
     * Set proportion
     *
     * @param Proporiton $proportion
     * @return Evolution
     */
    public function setProportion($proportion)
    {
        $this->proportion = $proportion;

        return $this;
    }
}
