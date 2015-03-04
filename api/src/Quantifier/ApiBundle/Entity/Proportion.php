<?php

namespace Quantifier\ApiBundle\Entity;

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
}
