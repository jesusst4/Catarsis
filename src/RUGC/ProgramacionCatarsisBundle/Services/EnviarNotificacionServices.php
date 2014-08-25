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

    public function notificarNuevoComentario() {
        $mensaje = new \Swift_Message(); // we create a new instance of the Swift_Message class
        $mensaje->setContentType('text/html')
                ->setSubject('Nuevo comentario de programación') // we configure the title
                ->setFrom('jesusst4@gmail.com') // we configure the sender
                ->setTo('jesusst4@gmail.com') // we configure the recipient
                ->setBody("<html>
                <head>
                     <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                </head>
                <body>
                <p>En el siguiente enlace se muestra la lista de comentarios pendientes de revisar.</p> 
                <br> 
                <a href='http://catarsis/comentario/es/lista'>Comentarios pendientes de revisar</a>
                </body>
            </html>")
        ;
        $this->mail->send($mensaje);
    }

    public function notificarComentarioEliminado($pComentario) {
        $mensaje = new \Swift_Message(); // we create a new instance of the Swift_Message class
        $mensaje->setContentType('text/html')
                ->setSubject('Su comentario ha sido eliminado') // we configure the title
                ->setFrom('jesusst4@gmail.com') // we configure the sender
                ->setTo($pComentario->getCorreo()) // we configure the recipient
                ->setBody("<html>
                <head>
                     <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                </head>
                <body>
                <p>Por políticas de Grupo Catarsis, el comentario realizado se ha eliminado bedido al contenido de este.</p> 
                <br> 
                <p><a href='http://catarsis/contenido/es/home'>Grupo Catarsis</a></p>
                </body>
            </html>")
        ;
        $this->mail->send($mensaje);
    }

}
