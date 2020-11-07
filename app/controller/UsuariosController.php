<?php

    class UsuariosController{

        public function index(){    
            if($_SESSION['usr']['user_lvl'] == 1){                  
                try{            
                    $user = new User;               
                    $data = $user->listUsers();               

                }catch(\Exception $e){
                    return 'erro';               
                }
                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader, [               
                'auto_reload' => true
                ]);
                for( $i = 0 ; $i < count($data) ; $i++){
                    $dados_usuarios[] = $data[$i];
                }
                $template = $twig->load('listusers.html');
                $header    = $twig->load('includes/header.html');
                echo $header->render(["lvl" => $_SESSION['usr']['user_lvl']]); 
                echo $template->render([ "n" => $dados_usuarios]);
                }else{
                    header('Location: http://rafaelalmeidadev.com/infonit/noticias/gerais');    
                }        
        }
        public function editar($id){
            if($_SESSION['usr']['user_lvl'] == 1){      
            try{            
                $user = new User;               
                $data = $user->editUser($id);               

            }catch(\Exception $e){
                return 'erro';               
            }

            
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [           
            'auto_reload' => true
            ]); 
            for( $i = 0 ; $i < count($data) ; $i++){
                $dados_usuarios[] = $data[$i];
            }

            $template = $twig->load('editar_usuarios.html');
            $header    = $twig->load('includes/header.html');
            echo $header->render(["lvl" => $_SESSION['usr']['user_lvl']]); 
            echo $template->render([ "n" => $dados_usuarios]);     
            }else{
                header('Location: http://rafaelalmeidadev.com/infonit/noticias/gerais');    
            }
          
        }
        public function excluir($id){
            try{            
                $data = new User;                                
                if($data->deleteUser($id)){
                    header('Location: http://rafaelalmeidadev.com/infonit/usuarios/index');
                }
                
            }catch(\Exception $e){
                return 'erro';               
            }
        }
        public function atualizarusuarios($id){
            try{            
                $data = new User;  
                $array = $_POST;                
                if($data->updateUser($array)){
                    header('Location: http://rafaelalmeidadev.com/infonit/usuarios/index');
                }
            }catch(\Exception $e){
                return 'erro';               
            }
        }
        public function editarvisitante($id){
            try{            
                $user = new User;               
                $data = $user->editVisitante($id);               

            }catch(\Exception $e){
                return 'erro';               
            }

          
            
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [           
            'auto_reload' => true
            ]); 
            for( $i = 0 ; $i < count($data) ; $i++){
                $dados_usuarios[] = $data[$i];
            }

            $template = $twig->load('editar_visitante.html');
            $header    = $twig->load('includes/header.html');
            echo $header->render(["lvl"  => $_SESSION['usr']['user_lvl']]); 
            echo $template->render([ "n" => $dados_usuarios]);     
            }
        }

