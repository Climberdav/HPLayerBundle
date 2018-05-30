<?php

namespace Climberdav\HPLayerBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;
use Climberdav\HPLayerBundle\Entity\Server;

/**
 * Class ServerRepository
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Entity\Repository
 */
class ServerRepository extends EntityRepository
{
    /**
     * findAll override to implement the default orderBy clause on firstDateOfBase
     *
     * @return Server[]
     */
    public function findAll()
    {
        return $this->findBy([], ['firstDayOfServer' => 'DESC']);
    }

    /**
     * Find all enabled server ordered by firsrDateOfBase
     *
     * @return Server[]
     */
    public function findEnabledServer()
    {
        return $this->findBy(['disabled' => false], ['firstDayOfServer' => 'DESC']);
    }
}