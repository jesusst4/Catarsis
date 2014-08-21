<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReporteProgramaciones
 *
 * @author gvasquez
 */

namespace RUGC\ProgramacionCatarsisBundle\Services;

use Doctrine\Common\Collections\ArrayCollection;
use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;
use ZendPdf\Style;

class ReporteProgramacionesServices {

    private $doctrine;

    public function __construct($serviceDoctine) {
        $this->doctrine = $serviceDoctine;
    }

    public function generarPDFProgramaciones($mes, $fecha) {

        $em = $this->doctrine->getManager();

        $listaProgramaciones = $em->getRepository('RUGCProgramacionCatarsisBundle:Programacion')->programacionesXMes($fecha);

        $pdf = new \ZendPdf\PdfDocument(__DIR__ . '/documentos/plantillaProgramaciones.pdf', NULL, TRUE);
        $pageIntroduccion = $pdf->pages[0];

        $style = $this->estilo();
        $pageIntroduccion->setFont($style->getFont(), $style->getFontSize());
        $posY = 620;

        $pageIntroduccion->drawText($mes, 400, $posY);
        $pageIntroduccion->drawText($mes, 400, $posY - 360);
        $pageProgramaciones = $pdf->pages[1];
        $styleProg = $this->estiloProgramaciones();
        $pageProgramaciones->setFont($styleProg->getFont(), $styleProg->getFontSize());

        $this->programacionRadioArriba($pageProgramaciones, $listaProgramaciones);

        $this->programacionTVArriba($pageProgramaciones, $listaProgramaciones);

        $this->programacionRadioAbajo($pageProgramaciones, $listaProgramaciones);

        $this->programacionTVAbajo($pageProgramaciones, $listaProgramaciones);

        $pdf->save(__DIR__ . '/documentos/doc.pdf');
        return $pdf;
    }

    private function estilo() {
        $style = new \ZendPdf\Style();
        $style->setFont(\ZendPdf\Font::fontWithName(\ZendPdf\Font::FONT_HELVETICA), 12);
        $style->setFontSize(12);
        return $style;
    }

    private function estiloProgramaciones() {
        $style = new \ZendPdf\Style();
        $style->setFont(\ZendPdf\Font::fontWithName(\ZendPdf\Font::FONT_HELVETICA), 10);
        $style->setFontSize(8);
        return $style;
    }

    function drawCenteredText($page, $text, $bottom) {
        $text_width = $this->getTextWidth($text, $page->getFont(), $page->getFontSize());
        $left = (330 - $text_width) / 2;

        $page->drawText($text, $left, $bottom, 'UTF-8');
    }

    function drawCenteredTextTv($page, $text, $bottom) {
        $text_width = $this->getTextWidth($text, $page->getFont(), $page->getFontSize());
        $left = (840 - $text_width) / 2;

        $page->drawText($text, $left, $bottom, 'UTF-8');
    }

    function getTextWidth($text, $font, $font_size) {
        $characters = array();
        for ($i = 0; $i < strlen($text) - 1; $i++) {
            $characters[] = (ord($text[$i++]) << 8) | ord($text[$i]);
        }
        $glyphs = $font->glyphNumbersForCharacters($characters);
        $widths = $font->widthsForGlyphs($glyphs);
        $text_width = (array_sum($widths) / $font->getUnitsPerEm()) * $font_size;
        return $text_width;
    }

    private function programacionRadioArriba($pageProgramaciones, $listaProgramaciones) {
        $posYPro = 720;
        foreach ($listaProgramaciones as $programacion) {

            if ($programacion->getTipo() == 1) {
                $this->drawCenteredText($pageProgramaciones, $programacion->getFecha()->format('d-m-Y'), $posYPro);
                $this->drawCenteredText($pageProgramaciones, $programacion->getTitulo(), $posYPro - 9);
                if ($programacion->getObra()) {
                    $this->drawCenteredText($pageProgramaciones, $programacion->getObra(), $posYPro - 18);
                }
                $lines = array();
                foreach (explode("\n", $programacion->getDescripciones()) as $line) {
                    $lines = array_merge($lines, explode("\n", wordwrap($line, 50, "\n")));
                }
                foreach ($lines as $i => $line) {
                    if ($programacion->getObra()) {
                        $this->drawCenteredText($pageProgramaciones, $line, $posYPro - 27);
                    } else {
                        $this->drawCenteredText($pageProgramaciones, $line, $posYPro - 18);
                    }
                    $posYPro = $posYPro - 9;
                }
                if ($programacion->getObra()) {
                    $posYPro = $posYPro - 32;
                } else {
                    $posYPro = $posYPro - 23;
                }
            }
        }
    }

    private function programacionRadioAbajo($pageProgramaciones, $listaProgramaciones) {
        $posYPro = 325;
        foreach ($listaProgramaciones as $programacion) {

            if ($programacion->getTipo() == 1) {
                $this->drawCenteredText($pageProgramaciones, $programacion->getFecha()->format('d-m-Y'), $posYPro);
                $this->drawCenteredText($pageProgramaciones, $programacion->getTitulo(), $posYPro - 9);
                if ($programacion->getObra()) {
                    $this->drawCenteredText($pageProgramaciones, $programacion->getObra(), $posYPro - 18);
                }

                $lines = array();
                foreach (explode("\n", $programacion->getDescripciones()) as $line) {
                    $lines = array_merge($lines, explode("\n", wordwrap($line, 50, "\n")));
                }
                foreach ($lines as $i => $line) {
                    if ($programacion->getObra()) {
                        $this->drawCenteredText($pageProgramaciones, $line, $posYPro - 27);
                    } else {
                        $this->drawCenteredText($pageProgramaciones, $line, $posYPro - 18);
                    }
                    $posYPro = $posYPro - 9;
                }
                if ($programacion->getObra()) {
                    $posYPro = $posYPro - 32;
                } else {
                    $posYPro = $posYPro - 23;
                }
            }
        }
    }

    private function programacionTVArriba($pageProgramaciones, $listaProgramaciones) {
        $posYPro = 720;
        foreach ($listaProgramaciones as $programacion) {

            if ($programacion->getTipo() == 2) {
                $this->drawCenteredTextTv($pageProgramaciones, $programacion->getFecha()->format('d-m-Y'), $posYPro);
                $this->drawCenteredTextTv($pageProgramaciones, $programacion->getTitulo(), $posYPro - 9);
                if ($programacion->getObra()) {
                    $this->drawCenteredTextTv($pageProgramaciones, $programacion->getObra(), $posYPro - 18);
                }

                $lines = array();
                foreach (explode("\n", $programacion->getDescripciones()) as $line) {
                    $lines = array_merge($lines, explode("\n", wordwrap($line, 50, "\n")));
                }
                foreach ($lines as $i => $line) {
                    if ($programacion->getObra()) {
                        $this->drawCenteredTextTv($pageProgramaciones, $line, $posYPro - 27);
                    } else {
                        $this->drawCenteredTextTv($pageProgramaciones, $line, $posYPro - 18);
                    }
                    $posYPro = $posYPro - 9;
                }
                if ($programacion->getObra()) {
                    $posYPro = $posYPro - 32;
                } else {
                    $posYPro = $posYPro - 23;
                }
            }
        }
    }

    private function programacionTVAbajo($pageProgramaciones, $listaProgramaciones) {
        $posYPro = 325;
        foreach ($listaProgramaciones as $programacion) {

            if ($programacion->getTipo() == 2) {
                $this->drawCenteredTextTv($pageProgramaciones, $programacion->getFecha()->format('d-m-Y'), $posYPro);
                $this->drawCenteredTextTv($pageProgramaciones, $programacion->getTitulo(), $posYPro - 9);
                $this->drawCenteredTextTv($pageProgramaciones, $programacion->getObra(), $posYPro - 18);

                $lines = array();
                foreach (explode("\n", $programacion->getDescripciones()) as $line) {
                    $lines = array_merge($lines, explode("\n", wordwrap($line, 50, "\n")));
                }
                foreach ($lines as $i => $line) {
                    if ($programacion->getObra()) {
                        $this->drawCenteredTextTv($pageProgramaciones, $line, $posYPro - 27);
                    } else {
                        $this->drawCenteredTextTv($pageProgramaciones, $line, $posYPro - 18);
                    }
                    $posYPro = $posYPro - 9;
                }
                if ($programacion->getObra()) {
                    $posYPro = $posYPro - 32;
                } else {
                    $posYPro = $posYPro - 23;
                }
            }
        }
    }

}
