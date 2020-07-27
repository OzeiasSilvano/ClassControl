<?php

class UtilDao {
    
    private static function IniciarSessao() {
    if(!isset($_SESSION)) {
        session_start();
    }
}
    
    public static function CriarSessao($id_user) {
        
        self::IniciarSessao();
        
        $_SESSION['cod'] = $id_user;
        
    }


    public static function CodigoLogado() {
        self::IniciarSessao();
        if (isset($_SESSION['cod'])) {
            return $_SESSION['cod'];
        }
        
        return null;
    }
    
    public static function Deslogar() {
        self::IniciarSessao();
        
        unset($_SESSION['cod']);
        
        header('location: login.php');
        
    }
    
    public static function VerLogado() {
        self::IniciarSessao();
        
        if (!isset($_SESSION['cod'])) {
            header('location: login.php');
        }
        
    }
    
}