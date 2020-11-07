<?php

    class PainelController{

        public function index(){    
            if($_SESSION['usr']['user_lvl'] == 1){      
                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader, [                   
                    'auto_reload' => true
                ]);           
                $header    = $twig->load('includes/header.html'); 
                $template = $twig->load('painel.html');        
                $parameters['name_user'] = $_SESSION['usr']['name_user'];  
                echo $header->render(["lvl" => $_SESSION['usr']['user_lvl']]);  
                echo $template->render($parameters); 
            }
        }

       
        
        public function sair(){
            unset($_SESSION['usr']);
            session_destroy();
            header('Location: http://rafaelalmeidadev.com/infonit/');
        }
       
    }