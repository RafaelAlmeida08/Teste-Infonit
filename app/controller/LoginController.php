<?php

    class LoginController{

        public function index(){     
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [               
                'auto_reload' => true
            ]);
            $template = $twig->load('index.html');
            $parameters['error'] = $_SESSION['msg_error'] ?? null;                 
            return $template->render($parameters);
        }

        public function registro(){               
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [                   
                'auto_reload' => true
            ]);
            $template = $twig->load('registro.html');        
            $parameters['error'] = $_SESSION['msg_error'] ?? null;             
            echo $template->render($parameters); 
            
        }
        public function registrarusuarios(){
            try{            
                $user = new User;              
                $array = $_POST;  
                $result = $user->registerUser($array);
                if($result){
                    header('Location: http://rafaelalmeidadev.com/infonit/noticias/geral');
                }                   

            }catch(\Exception $e){
                $_SESSION['msg_error'] = array(
                    'msg'   => $e->getMessage(), 
                    'count' => 0);
                header('Location: http://rafaelalmeidadev.com/infonit/login/registro');     
            }
        }

        public function entrar(){
            try{            
                $user = new User;
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->validateLogin();
                header('Location: http://rafaelalmeidadev.com/infonit/noticias/destaques');
            }catch(\Exception $e){
                $_SESSION['msg_error'] = array(
                    'msg'   => $e->getMessage(), 
                    'count' => 0);
                header('Location: http://rafaelalmeidadev.com/infonit/login/index');
            }
            
        }

    }