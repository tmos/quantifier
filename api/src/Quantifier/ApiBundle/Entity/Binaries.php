<?php

namespace Quantifier\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * binaries
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quantifier\ApiBundle\Entity\BinariesRepository")
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
}