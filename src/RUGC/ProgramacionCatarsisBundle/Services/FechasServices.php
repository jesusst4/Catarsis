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

    public function obtenerNombreMes($pMes, $pIdioma) {

        $mesesEs = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $mesesIn = array('January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December');
        $meses = $mesesIn;

        if ($pIdioma == 'es') {
            $meses = $mesesEs;
        }
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

    public function obtenerNombreMesSeleccionado($fecha, $pIdioma) {
        $fechaS = preg_split("/-/", $fecha);
        $pMes = $fechaS[1];
        $mesesEs = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $mesesIn = array('January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December');
        $meses = $mesesIn;

        if ($pIdioma == 'es') {
            $meses = $mesesEs;
        }
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

    public function obtenerFechaEnNumeros($pMes, $pAnio, $pIdioma) {
        $mesesEs = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $mesesIn = array('January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December');
        $meses = $mesesIn;

        if ($pIdioma == 'es') {
            $meses = $mesesEs;
        }
        $fecha = "";

        foreach ($meses as $key => $value) {
            $mes = $key + 1;
            
            if ($value == $pMes) {
                $fecha = $pAnio . "-" . $mes . "-01";
                break;
            }
            echo ''.$fecha;
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
