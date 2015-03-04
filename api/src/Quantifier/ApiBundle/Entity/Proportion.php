<?php

namespace Quantifier\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * proportion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quantifier\ApiBundle\Entity\ProportionRepository")
 */
class Proportion
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
     * @var integer
     *
     * @ORM\Column(name="creator", type="integer")
     */
    private $creator;

    /**
    *  @ORM\OneToMany(targetEntity="Quantifier\ApiBundle\Entity\Data", mappedBy="proportion")
    */
    private $evolutions;


    /**
    *  Initialize evolutions
    */
    public function __construct()
    {
        $this->evolutions = new ArrayCollection();
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
     * Set creator
     *
     * @param integer $creator
     * @return proportion
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
    *  Add evolution
    *
    *  @param Evolution $evolution
    *  @return Track
    */
    public function addEvolutions(Evolution $evolution)
    {
        $this->evolutions[] = $evolution;

        $evolution->setProportion($this);

        return $this;
    }

    /**
    *  Remove evolution
    *
    *  @param Evolution $evolution
    */
    public function removeEvolution(Evolution $evolution)
    {
        $this->evolutions->removeElements($evolution);
    }

    /**
    * Get evolutions
    *
    * @return Evolutions[]
    */
    public function getAllEvolution()
    {
        return $this->evolutions;
    }
}
