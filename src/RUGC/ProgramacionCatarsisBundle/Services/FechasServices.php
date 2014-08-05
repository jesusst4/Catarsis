<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FechasServices
 *
 * @author jsoto-gvasquez
 */

namespace RUGC\ProgramacionCatarsisBundle\Services;

class FechasServices {

    public function obtenerNombreMes($pMes) {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fecha = "";
        $anio = strftime('%Y');
        foreach ($meses as $key => $value) {
            $mes = $key + 1;
            if ($mes == $pMes) {
                $fecha = $value . "-" . $anio;
                break;
            }
        }
        return $fecha;
    }

    private function obtenerFechaEnNumeros($pMes, $pAnio) {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fecha = "";

        foreach ($meses as $key => $value) {
            $mes = $key + 1;
            if ($value == $pMes) {
                $fecha = $pAnio . "-" . $mes . "-01";
                break;
            }
        }
        return $fecha;
    }

}
