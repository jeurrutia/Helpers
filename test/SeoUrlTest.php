<?php

use Helpers;

class SeoUrlTest extends PHPUnit_Framework_TestCase
{
    protected $object;
    public function setUp() {
        require_once '../src/SeoUrl.php';
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
              'string_to_seo_url'   => 'Foo Bar Baz',
              'expected'            => 'foo-bar-baz',
            ),
            "Words with '-'" => array(
              'string_to_seo_url'   => 'Foo-Bar',
              'expected'            => 'foo-bar',
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

