<?php

namespace Quantifier\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * data
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quantifier\ApiBundle\Entity\dataRepository")
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=512)
     */
    private $comment;

    /**
    *  @ORM\ManyToOne(targetEntity="Quantifier\ApiBundle\Entity\Track", inversedBy="datas")
    *  @ORM\JoinColumn(nullable=true)
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
     * Set date
     *
     * @param \DateTime $date
     * @return data
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
