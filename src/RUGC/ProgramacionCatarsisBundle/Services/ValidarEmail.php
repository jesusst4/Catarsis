<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidarEmail
 *
 * @author jsoto-gvasquez
 */

namespace RUGC\ProgramacionCatarsisBundle\Services;

define("CRLF", "\r\n");  // [ENTER]
define("PORT", "25");    // SMTP PORT.

Class ValidarEmail {

    private $mail;
    private $user;
    private $domain;

    public function validate() {
        if ($sock = $this->connectSMTP()) {
            if ($this->getResponse($sock) == "220") {
                $this->writeData($sock, "EHLO " . $this->domain . CRLF);
//                echo "Mandando helo $this->domain\n<br>";
                if ($this->getResponse($sock) == "250") {
                    $this->writeData($sock, "HELO " . $this->domain . CRLF);
                    if ($this->getResponse($sock) == "250") {
                        $this->writeData($sock, "MAIL FROM: <".$this->user."@" . $this->domain.">". CRLF);
                        if ($this->getResponse($sock) == "250") {

                            $this->writeData($sock, "RCPT TO: <" . $this->user . "@" . $this->domain .">". CRLF);
                            if ($this->getResponse($sock) == "250") {
                                echo "email valido\n";
                                $this->writeData($sock, "QUIT" . CRLF);
                                $this->socketClose($sock);
                                return 1; // valid email
                            }
                        }
                    }
                }
            }
        }
        return 0;
    }

    private function socketClose($socket) {
        socket_close($socket);
    }

    private function writeData($socket, $data) {
        if ($socket) {
            if (socket_write($socket, $data, strlen($data))) {
                return 1;
            }
        }
        return 0;
    }

    private function getResponse($socket) {
        if ($socket) {
            // echo "Esperando respuesta\n";
            $response = socket_read($socket, 2048);
            // echo "respuesta: $response\n";
            if (strlen($response) > 0) {

//                echo $response . "<br>";
                $rescode = $response[0] . $response[1] . $response[2];
                return $rescode;
            }
        }
    }

    private function connectSMTP() {

        if (function_exists("socket_create") && function_exists('socket_connect')) {  //Ok.. existen las funciones..
            if (empty($this->domain) || ($this->domain == ""))
                $this->extractData();
            if ($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {

                $mxrecords = $this->getMxRecords();
                /* echo count($mxrecords)."\n";
                  echo "records:".(int)$mxrecords."\n";
                  print_r($mxrecords); */
                if (isset($mxrecords) && (int) $mxrecords > 0) {
                    if ($this->validString()) {
                        foreach ($mxrecords as $records) {
                            if (isset($records) && $records != "") {
                                // echo "Conectando con: $records \n";
                                $address = gethostbyname($records);
                                if ($address != $records) {

                                    if (socket_connect($sock, $address, PORT)) {
                                        // echo "conectado";
                                        return $sock; //Conected :) devolvemos el handle
                                    }
                                }
                            }
                        }
                    } else
                        return 0;
                } else
                    return 0;
            }
        }
        return 0; // no logramos conectar / something has failed.. we cannot connect.
    }

    public function validString() {

        $email = $this->mail;
        if (eregi("^([a-z0-9._]+)@([a-z0-9.-_]+).([a-z]{2,4})$", $email)) {
            return 1;
        }
        return 0;
    }

    public function getMxRecords() {
        $dominio = $this->domain;
        if (isset($dominio) && ($dominio != "")) {
            if (getmxrr($dominio, $records)) {
                if (count($records) > 0) { // hay mx records...
                    return $records;
                } else {  // NO hay MX records.. entonces usamos el dominio para conectar. 
                    return $dominio; // retornamos el dominio tal cual..
                }
            } else {
                return 0; // algo fallo... no pudimos conectar
            }
        }
        return 0; // de nueva cuenta algo falló...
    }

    private function extractData() {
        $data = explode("@", strtolower($this->mail));
        $this->user = $data[0];
        $this->domain = $data[1];
    }

    function __construct($email) {
        $this->mail = $email;
        $this->extractData();
    }

}

?>