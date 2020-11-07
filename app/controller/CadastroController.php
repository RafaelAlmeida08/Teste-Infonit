<?php

    class CadastroController{       
        public function usuarios(){           
            if($_SESSION['usr']['user_lvl'] == 1){
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [                
                'auto_reload' => true
            ]);            
            $template  = $twig->load('cadastro_usuarios.html');   
            $header    = $twig->load('includes/header.html');
            $parameters['error'] = $_SESSION['msg_error'] ?? null;     
            echo $header->render(["lvl" => $_SESSION['usr']['user_lvl']]);
            echo $template->render($parameters); 
            }else{
                header('Location: http://rafaelalmeidadev.com/infonit/noticias/gerais');    
            }
        
        }
        public function noticias(){

            if($_SESSION['usr']['user_lvl'] == 1){
                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader, [                   
                    'auto_reload' => true
                ]);            
                $template  = $twig->load('cadastro_noticias.html');       
                $header    = $twig->load('includes/header.html');
                $parameters['error'] = $_SESSION['msg_error'] ?? null;     
                echo $header->render(["lvl" => $_SESSION['usr']['user_lvl']]); 
                echo $template->render($parameters); 
            }else{           
                header('Location: http://rafaelalmeidadev.com/infonit/noticias/gerais');    
              
            }
        }
        public function registrarusuarios(){
            try{            
                $user = new User;              
                $array = $_POST;  
                $result = $user->registerUser($array);
                if($result){
                    header('Location: http://rafaelalmeidadev.com/infonit/usuarios/index');
                }                 

            }catch(\Exception $e){
                $_SESSION['msg_error'] = array(
                    'msg'   => $e->getMessage(), 
                    'count' => 0);                   
                header('Location: http://rafaelalmeidadev.com/infonit/cadastro/usuarios');    
            }
        }
        public function registrarnoticias(){
            try{            
                $noticia  = new Noticias;              
                $array = $_POST;
                $img   = $_FILES; 
                if($noticia->registrarNoticia($array,$img)){
                    $_SESSION['usr']['sucesso'] = 'Noticia postada com sucesso';
                    header('Location: http://rafaelalmeidadev.com/infonit/noticias/gerais');
                }  
            }catch(\Exception $e){
                return 'erro';               
            }
        }
    }