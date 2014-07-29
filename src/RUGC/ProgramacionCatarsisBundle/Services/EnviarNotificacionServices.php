<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnviarNotificacion
 *
 * @author jsoto
 */

namespace RUGC\ProgramacionCatarsisBundle\Services;

class EnviarNotificacionServices {

    //put your code here

    private $mail;

    public function __construct($mail) {
        $this->mail = $mail;
    }

    public function enviarEmail() {
        $mensaje = new \Swift_Message(); // we create a new instance of the Swift_Message class
        $mensaje->setContentType('text/html')
                ->setSubject('Nuevos comentarios en alguna de las programaciones') // we configure the title
                ->setFrom('jesusst4@gmail.com') // we configure the sender
                ->setTo('jesusst4@gmail.com') // we configure the recipient
                ->setBody("<html>
                <head>
                     <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                </head>
                <body>
                <p>Ingrese al siguiente enlace para revisar la lista de nuevos comentarios</p> 
                <br> 
                <p><a>http://catarsis/app_dev.php/comentario/</a></p>
                </body>
            </html>")
        ;
        $this->mail->send($mensaje);
    }

}
