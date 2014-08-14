<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Captcha
 *
 * @author jsoto-gvasquez
 */

namespace RUGC\ProgramacionCatarsisBundle\Services;

class Captcha {

    

    function criaimagem() {
        global $key;

        $key = $this->key(5);
        $img = ImageCreate(100, 30);
        $fundo = ImageColorAllocate($img, 87, 156, 132);
        $texto = ImageColorAllocate($img, 255, 255, 255);
        ImageString($img, 7, 23, 6, $key, $texto);
        ImageJpeg($img, __DIR__ . "/../../../../web/captcha.jpg");
        return $key;
    }
    function key($t) {
        $key="";
        $car = "1234567890abcdefghijklmnopqrstuvwxyz";
        for ($i = 0; $i < $t; $i++) {
            $key .= $car{rand(0, strlen($car) - 1)};
        }
        return $key;
    }

}
