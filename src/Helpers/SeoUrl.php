<?php

namespace Helpers;

/**
 * Class to transform words to a seo friendly format.
 */
class SeoUrl 
{
    /**
     * The separator chars.
     * 
     * @var array
     */
    protected $separator_chars_to_replace;
    
    /**
     * Latin characters to be replaced.
     * 
     * @var array 
     */
    protected $latin_chars_to_replace;
    
    /**
     * Latin characters valids.
     * 
     * @var array
     */
    protected $latin_chars_valids;
    
    /**
     * PCRE pattern chars to sanitize.
     * 
     * @var array
     */
    protected $pattern_chars_to_sanitize;
    
    /**
     * Chars valids after clean up.
     * 
     * @var array
     */
    protected $chars_sanitized;
    
    /**
     * Constructor by default.
     */
    public function __construct() {
        $this->separator_chars_to_replace   = array( ' ', '&', '\r\n', '\n', '+', '_' );
        
        $this->latin_chars_to_replace       = array( 'á', 'é', 'í', 'ó', 'ú', 'ñ', 'à', 'è', 'ì', 'ò', 'ù',
            'Á', 'É', 'Í', 'Ó', 'Ú', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Ñ' );
        $this->latin_chars_valids           = array( 'a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u',
            'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n' );
        
        $this->pattern_chars_to_sanitize    = array( '/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/' );
        $this->chars_sanitized              = array( '', '-', '' );
        
    }
    
    /**
     * Gets the SEO friendly version of the string.
     * 
     * @param string $string_to_seo_url String to parse and to transform.
     * @return string
     */
    public function get( $string_to_seo_url ) {        
        return $this->sanitizeString(
            $this->replaceLatinChars(
                $this->replaceSeparatorCharsToHyphen( $string_to_seo_url )
            )
        );
    }
    
    /**
     * Sanitizes the string param.
     * 
     * @param string $string String to sanitize.
     * @return string
     */
    protected function sanitizeString( $string ) {        
        return preg_replace ( 
            $this->pattern_chars_to_sanitize, 
            $this->chars_sanitized, 
            strtolower( trim( $string ) ) 
        );
    }
    
    /**
     * Replace separator chars to a hyphen char.
     *
     * @param string $string String to parse.
     * @return string
     */
    protected function replaceSeparatorCharsToHyphen( $string ) {       
        return str_replace ( $this->separator_chars_to_replace, '-', $string );
    }
    
    /**
     * Replace Latin chars in a valid url format.
     *
     * @param string $string String to parse.
     * @return string
     */
    protected function replaceLatinChars( $string ) {
        return str_replace (
            $this->latin_chars_to_replace, 
            $this->latin_chars_valids, 
            $string
        );
    }
}
