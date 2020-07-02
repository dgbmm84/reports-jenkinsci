<?php

namespace App\Data\Database;

use App\Data\Model\Entity\ReportEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ReportDatabase extends EntityRepository
{

    /**
     * ReportDatabase constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $metadata = $em->getClassMetadata(ReportEntity::class);
        parent::__construct($em, $metadata);
    }

    /**
     * @param ReportEntity $entity
     * @param bool $flush
     * @return ReportEntity|bool
     * @throws \Exception
     */
    public function add($entity, $flush = true): ?ReportEntity
    {

        try {
            $this->getEntityManager()->persist($entity);
            if ($flush) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->refresh($entity);
            }

            return $entity;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param ReportEntity $entity
     * @param bool $flush
     * @return ReportEntity|bool
     * @throws \Exception
     */
    public function update($entity, $flush = true): ReportEntity
    {
        try {
            $this->getEntityManager()->merge($entity);
            if ($flush) {
                $this->getEntityManager()->flush();
                $this->getEntityManager()->refresh($entity);
            }

            return $entity;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param ReportEntity $entity
     * @param bool $flush
     * @return bool
     * @throws \Exception
     */
    public function delete($entity, $flush = true): bool
    {
        try {
            $this->getEntityManager()->remove($entity);
            if ($flush) {
                $this->getEntityManager()->flush();
            }
            return true;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}