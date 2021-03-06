<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * OpcionesMenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OpcionesMenuRepository extends EntityRepository {

    public function consultarMenuPrincipal() {

        return $this->getEntityManager()->createQuery('SELECT om FROM RUGCProgramacionCatarsisBundle:OpcionesMenu om WHERE om.menuPrincipal = 1 order by om.prioridad ASC')->getResult();
    }

    public function consultarHome() {
        return $this->getEntityManager()->createQuery('SELECT c.id FROM RUGCProgramacionCatarsisBundle:OpcionesMenu c where c.prioridad = 1')->getResult();
    }

}
