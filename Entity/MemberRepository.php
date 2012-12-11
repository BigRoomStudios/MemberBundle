<?php

namespace BRS\MemberBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MemberRepository extends EntityRepository
{
	public function getByName($name)
	{
		
		$names = explode(' ', $name);
		
		$em = $this->getEntityManager();
			
		$query = $this->createQueryBuilder('m')
			    ->where('m.first_name = :first_name')
			    ->andWhere('m.last_name = :last_name')
			    ->setParameter('first_name', $names[0])
			    ->setParameter('last_name', $names[1])
			    ->getQuery();
			
		$members = $query->getResult();
		
		return $members;
	}
}