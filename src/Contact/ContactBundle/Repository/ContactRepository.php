<?php

namespace Contact\ContactBundle\Repository;

/**
 * ContactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactRepository extends \Doctrine\ORM\EntityRepository
{
    public function lu()
    {
        $qb=$this->createQueryBuilder('c')
            ->select('c')
            ->where('c.traite = 1')
            ->orderBy('c.date', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
