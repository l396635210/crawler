<?php

namespace WordPressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpTermRelationships
 *
 * @ORM\Table(name="wp_term_relationships", indexes={@ORM\Index(name="term_taxonomy_id", columns={"term_taxonomy_id"})})
 * @ORM\Entity
 */
class WpTermRelationships
{
    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $objectId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="term_taxonomy_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $termTaxonomyId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="term_order", type="integer", nullable=false)
     */
    private $termOrder = '0';



    /**
     * Set objectId
     *
     * @param integer $objectId
     *
     * @return WpTermRelationships
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set termTaxonomyId
     *
     * @param integer $termTaxonomyId
     *
     * @return WpTermRelationships
     */
    public function setTermTaxonomyId($termTaxonomyId)
    {
        $this->termTaxonomyId = $termTaxonomyId;

        return $this;
    }

    /**
     * Get termTaxonomyId
     *
     * @return integer
     */
    public function getTermTaxonomyId()
    {
        return $this->termTaxonomyId;
    }

    /**
     * Set termOrder
     *
     * @param integer $termOrder
     *
     * @return WpTermRelationships
     */
    public function setTermOrder($termOrder)
    {
        $this->termOrder = $termOrder;

        return $this;
    }

    /**
     * Get termOrder
     *
     * @return integer
     */
    public function getTermOrder()
    {
        return $this->termOrder;
    }
}
