<?php

use Helpers\SeoUrl;

class SeoUrlTest extends PHPUnit_Framework_TestCase
{
    protected $object;
    public function setUp() {
        require_once '../../src/Helpers/SeoUrl.php';
        $this->object = new Helpers\SeoUrl();        
    }
    
    public function seoUrlProvider()
    {
        return array(
            'One word' => array(
              'string_to_seo_url'   => 'Foo',
              'expected'            => 'foo',
            ),
            'Two words' => array(
              'string_to_seo_url'   => 'Foo Bar',
              'expected'            => 'foo-bar',
            ),
            'Three words' => array(
              'string_to_seo_url'   => 'Foo Bar_Baz',
              'expected'            => 'foo-bar-baz',
            ),
            "Words with '-'" => array(
              'string_to_seo_url'   => 'Foo-Bar',
              'expected'            => 'foo-bar',
            ),
            "Words with latin chars" => array(
              'string_to_seo_url'   => 'Martín el maño 926',
              'expected'            => 'martin-el-mano-926',
            ),
            "Words with URL separator chars" => array(
              'string_to_seo_url'   => 'Ola&k\nase\r\ntomas+birras+o&k\nase',
              'expected'            => 'ola-k-ase-tomas-birras-o-k-ase',
            ),
            "Special chars" => array(
              'string_to_seo_url'   => 'Ola[k]ase&nbsp;tomas_b‰i—rras+o&k\nase',
              'expected'            => 'olakase-nbsptomas-birras-o-k-ase',
            ),
        );
    }
    
    /**
     * @dataProvider seoUrlProvider
     */
    public function testSeoUrlBase( $string_to_seo_url, $expected ) {
        
        $result = $this->object->get( $string_to_seo_url );
        
        $this->assertEquals( $expected, $result, 'Test for seoUrl failed!' );
    }
            
}

