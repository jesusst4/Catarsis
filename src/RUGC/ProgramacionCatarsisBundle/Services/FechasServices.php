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

    public function obtenerNombreMesSeleccionado($fecha) {
        $fechaS = split("-", $fecha);
        $pMes = $fechaS[1];
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $fecha = "";
        $anio = $fechaS[0];
        foreach ($meses as $key => $value) {
            $mes = $key + 1;
            if ($mes == $pMes) {
                $fecha = $value . "-" . $anio;
                break;
            }
        }
        return $fecha;
    }

    public function obtenerFechaEnNumeros($pMes, $pAnio) {
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

    public function restarFecha($fecha) {
        $nuevafecha = strtotime('-1 month', strtotime($fecha));
        return $nuevafecha = date('Y-m-d', $nuevafecha);
    }

    public function SumarFecha($fecha) {
        $nuevafecha = strtotime('+1 month', strtotime($fecha));
        return $nuevafecha = date('Y-m-d', $nuevafecha);
    }

    public function obtenerPrimerDia($fecha) {
        
    }

}
