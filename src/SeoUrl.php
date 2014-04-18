<?php
namespace Helpers;

class SeoUrl 
{
    public function get( $url ) {
        $url = trim( $url );
        // Tranformamos todo a minusculas
        
        $url = strtolower($url);
        // Añaadimos los guiones
        
        $find = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace ($find, '-', $url);
        
        //Rememplazamos caracteres especiales latinos
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'à', 'è', 'ì', 'ò', 'ù',
        'Á', 'É', 'Í', 'Ó', 'Ú', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Ñ');
        
        $repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u',
        'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n');
        
        $url = str_replace ($find, $repl, $url);
        
        // Eliminamos y Reemplazamos demás caracteres especiales
        
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        
        $repl = array('', '-', '');
        
        $url = preg_replace ($find, $repl, $url);
        
        return $url;
    
    }
}
