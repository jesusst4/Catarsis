<?php

namespace RUGC\ProgramacionCatarsisBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProgramacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgramacionRepository extends EntityRepository {

    public function programacionesXMes($fecha) {
        $mes = date("m", strtotime($fecha));
        $anio = date("Y", strtotime($fecha));
        $ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $fechaInicio = $anio . "-" . $mes . "-" . "01";
        $fechaFin = $anio . "-" . $mes . "-" . $ultimo_dia;

        return $this->getEntityManager()->createQuery('SELECT p FROM RUGCProgramacionCatarsisBundle:Programacion p WHERE p.fecha >= :fecInicio AND  p.fecha <= :fecFin order by p.fecha')
                        ->setParameters(array(
                            'fecInicio' => $fechaInicio,
                            'fecFin' => $fechaFin
                        ))->getResult();
    }

    public function programacionACtual() {
        $mes = strftime('%m');
        $anio = strftime('%Y');
        $ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $fechaInicio = $anio . "-" . $mes . "-" . "1";
        $fechaFin = $anio . "-" . $mes . "-" . $ultimo_dia;

        return $this->getEntityManager()->createQuery('SELECT p FROM RUGCProgramacionCatarsisBundle:Programacion p WHERE p.fecha >= :fecInicio AND  p.fecha <= :fecFin order by p.fecha')
                        ->setParameters(array(
                            'fecInicio' => $fechaInicio,
                            'fecFin' => $fechaFin
                        ))->getResult();
    }

    public function programacionMesSecuencial($fechaInicial) {
        $arrayFecha = preg_split("/-/", $fechaInicial);
        $mes = $arrayFecha[1];
        $anio = $arrayFecha[0];
        $ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $fechaInicio = $fechaInicial;
        $fechaFin = $anio . "-" . $mes . "-" . $ultimo_dia;

        return $this->getEntityManager()->createQuery('SELECT p FROM RUGCProgramacionCatarsisBundle:Programacion p WHERE p.fecha >= :fecInicio AND  p.fecha <= :fecFin order by p.fecha')
                        ->setParameters(array(
                            'fecInicio' => $fechaInicio,
                            'fecFin' => $fechaFin
                        ))->getResult();
    }

    public function programacionXArtista_Titulo($pArtista, $pObra) {
        return $this->getEntityManager()->createQuery('SELECT p FROM RUGCProgramacionCatarsisBundle:Programacion p WHERE (p.titulo like :titulo or :titulo is null) AND (p.obra like :obra or :obra is null ) order by p.fecha')
                        ->setParameters(array(
                            'titulo' => $pArtista . "%",
                            'obra' => $pObra . "%"
                        ))->getResult();
    }

}
