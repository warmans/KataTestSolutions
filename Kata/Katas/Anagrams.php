<?php

namespace Kata\Katas;

/**
 * Kata based on /r/php post
 * 
 * Create a script that takes a string for input, and from that string, produces all other words 
 * (based on a dictionary or list of other possible words) that you can create from the letters of that string.
 * Note, you choose to leave out letters, but you may not repeat any letters unless they appear multiple times in 
 * the input string.
 * 
 */
class Anagrams extends \Kata\Core\KataAbstract {

    /**
     * _setUp must exist and must always set a testSuite. Unlike PHPUnit _setUp is called only once.
     */
    protected function _setUp() {
	        
        $testSuite = new \Kata\Core\TestSuite;
        
        $testSuite->addTest(\Kata\Core\Test::build("t.ammo",
            array(
                'a', 'am', 'm', 'ma', 'mamo', 'mao', 'mo', 'o', 'oam', 'om'), 
            array('ammo'))
        );
        
        $testSuite->addTest(\Kata\Core\Test::build("t.mamo",
            array(
                'a', 'am', 'ammo', 'm', 'ma', 'mao', 'mo', 'o', 'oam', 'om'), 
            array('mamo'))
        );
        
        $testSuite->addTest(\Kata\Core\Test::build("t.ab",
            array('a', 'b', 'ba'), 
            array('ab'))
        );
                 
        $this->setTestSuite($testSuite);	
        parent::_setUp();
		
    }

    public function mySolution($startingWord) {
        //do something
    }
		
}