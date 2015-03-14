<?php

namespace Quantifier\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="api_track")
 * @ORM\Entity(repositoryClass="Quantifier\ApiBundle\Entity\TrackRepository")
 */
class Track
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="creator", type="integer")
     */
    private $creator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
    *  @ORM\OneToMany(targetEntity="Quantifier\ApiBundle\Entity\Data", mappedBy="track")
    */
    private $datas;

    /**
    *  Initialize data
    */
    public function __construct()
    {
        $this->datas = new ArrayCollection();
    }


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
     * @return Track
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
     * Set creator
     *
     * @param integer $creator
     * @return Track
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return integer
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Track
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
     * Set type
     *
     * @param integer $type
     * @return Track
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
    *  Add data
    *
    *  @param Data $data
    *  @return Track
    */
    public function addData(Data $data)
    {
        $this->datas[] = $data;

        $data->setTrack($this);

        return $this;
    }

    /**
    *  Remove data
    *
    *  @param Data $data
    */
    public function removeData(Data $data)
    {
        $this->datas->removeElements($data);
    }

    /**
    * Get All data
    *
    * @return Data[]
    */
    public function getAllData()
    {
        return $this->datas;
    }
}
