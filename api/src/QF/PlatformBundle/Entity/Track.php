<?php

namespace QF\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="api_track")
 * @ORM\Entity(repositoryClass="QF\PlatformBundle\Entity\TrackRepository")
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
     * @var string
     *
     * @ORM\Column(name="creator", type="string")
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
     * @ORM\OneToMany(targetEntity="QF\PlatformBundle\Entity\Evolution", mappedBy="track")
     */
    private $evolutions;

    /**
     * @ORM\OneToMany(targetEntity="QF\PlatformBundle\Entity\Listing", mappedBy="track")
     */
    private $listings;

    /**
     * @ORM\OneToMany(targetEntity="QF\PlatformBundle\Entity\Binaries", mappedBy="track")
     */
    private $binaries;

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
     *  Add evolution
     *
     * @param Evolution $data
     * @return Track
     */
    public function addEvolution(Evolution $data)
    {
        $this->evolutions[] = $data;

        $data->setTrack($this);

        return $this;
    }

    /**
     *  Remove evolution
     *
     * @param Evolution $data
     */
    public function removeEvolution(Evolution $data)
    {
        $this->evolutions->removeElements($data);
    }

    /**
     * Get All evolution
     *
     * @return Evolution[]
     */
    public function getEvolutions()
    {
        return $this->evolutions;
    }

    /**
     *  Add data
     *
     * @param Listing $data
     * @return Track
     */
    public function addListing(Listing $data)
    {
        $this->listings[] = $data;

        $data->setTrack($this);

        return $this;
    }

    /**
     *  Remove listing
     *
     * @param Listing $data
     */
    public function removeData(Listing $data)
    {
        $this->listings->removeElements($data);
    }

    /**
     * Get All data
     *
     * @return Data[]
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     *  Add binaries
     *
     * @param Binaries $data
     * @return Track
     */
    public function addBinaries(Binaries $data)
    {
        $this->binaries[] = $data;

        $data->setTrack($this);

        return $this;
    }

    /**
     *  Remove binaries
     *
     * @param Binaries $data
     */
    public function removeBinaries(Binaries $data)
    {
        $this->binaries->removeElements($data);
    }

    /**
     * Get All binaries
     *
     * @return Binaries[]
     */
    public function getBinaries()
    {
        return $this->binaries;
    }
}
