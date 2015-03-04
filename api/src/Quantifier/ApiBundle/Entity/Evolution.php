<?php

namespace Quantifier\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * evolution
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quantifier\ApiBundle\Entity\EvolutionRepository")
 */
class Evolution extends Data
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
     * @ORM\Column(name="value", type="decimal")
     */
    private $value;

    /**
    *  @ORM\ManyToOne(targetEntity="Quantifier\ApiBundle\Entity\Proportion", inversedBy="evolutions")
    *  @ORM\JoinColumn(nullable=true)
    */
    private $proportion;


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
