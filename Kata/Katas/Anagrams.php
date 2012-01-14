<?php

namespace Kata\Katas;

/**
 * Solutions to Anagrams problem.
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
        
        //more tests to test execution time. Result word lists are too long to realistically test exact matches for
        
        /*
    
        $testSuite->addTest(\Kata\Core\Test::build("t.ammocoetiform",
            array(), 
            array('ammocoetiform'))
        );
        
        $testSuite->addTest(\Kata\Core\Test::build("t.undenominationalize",
            array(), 
            array('undenominationalize'))
        );
         */    
        
        $this->setTestSuite($testSuite);	
        parent::_setUp();
		
    }

    public function lineByLine($anagramSeed) {
        
        $fileinfo = new \SplFileInfo(RESOURCE.'wordlist.txt');
        $file = $fileinfo->openFile('r');
                
        $matchedWords = array();

        //filter any words longer than the requested word, any possible words convert to array. Don't store seed word.
        foreach($file as $line):
            
            //kill whitespace
            $line = trim($line);
            
            //word is empty or too long or the the seed - skip
            if(strlen($line) == 0 || strlen($line) > strlen($anagramSeed) || $line == $anagramSeed){
                continue;
            }
        
            $word = str_split($line);           
            $matchedLetters = 0;
            $letterPool = str_split($anagramSeed);
            
            //compare all it's letters against the anagram seed
            foreach($word as $key=>$letter):
                
                $foundLetterKey = array_search($letter, $letterPool); 
                
                if($foundLetterKey !== FALSE){
                    //once a letter has been used remove it from the possible letters to prevent matches re-using letters
                    unset($letterPool[$foundLetterKey]);
                    //note how many letters have been matched in this word
                    $matchedLetters++;
                }
            endforeach;
            
            //all letters of the current word matched the anagram seed  - this is an anagram or sub-word
            if($matchedLetters == count($word)){
                $matchedWords[] = implode("", $word);
            }
        endforeach;     
        
        return $matchedWords;
    }
    
    public function lineByLineImproved($anagramSeed) {
        
        $fileinfo = new \SplFileInfo(RESOURCE.'wordlist.txt');
        $file = $fileinfo->openFile('r');
                
        $matchedWords = array();
        
        $anagramSeedLength = strlen($anagramSeed);
        $anagramSeedAsArray = str_split($anagramSeed);
        foreach($file as $line):
            $line = trim($line);
            if(strlen($line) == 0 || strlen($line) > $anagramSeedLength || $line == $anagramSeed){
                continue;
            }
        
            $word = str_split($line);           
            $matchedLetters = 0;
            $letterPool = $anagramSeedAsArray;
            
            foreach($word as $key=>$letter):
                
                $foundLetterKey = array_search($letter, $letterPool); 
                
                if($foundLetterKey !== FALSE){
                    unset($letterPool[$foundLetterKey]);
                    $matchedLetters++;
                }
            endforeach;
            
            if($matchedLetters == count($word)){
                $matchedWords[] = implode("", $word);
            }
        endforeach;     
        
        return $matchedWords;
    }
    
    public function preloadArray($anagramSeed) {
        
        $fileinfo = new \SplFileInfo(RESOURCE.'wordlist.txt');
        $file = $fileinfo->openFile('r');
        
        $anagramSeedLength = strlen($anagramSeed);
        $anagramSeedAsArray = str_split($anagramSeed);
        
        $wordArray = array();
        foreach($file as $line):
            $line = trim($line);
            if(strlen($line) > 0 && strlen($line) <= $anagramSeedLength && $line != $anagramSeed){
                $wordArray[] = $line;
            }
        endforeach;
        
        $matchedWords = array();
        foreach($wordArray as $key=>$wordString):

            $word = str_split($wordString);
            $matchedLetters = 0;
            $letterPool = $anagramSeedAsArray;
            
            foreach($word as $key=>$letter):
                
                $foundLetterKey = array_search($letter, $letterPool); 
                
                if($foundLetterKey !== FALSE){
                    unset($letterPool[$foundLetterKey]);
                    $matchedLetters++;
                }
            endforeach;
            
            if($matchedLetters == count($word)){
                $matchedWords[] = implode("", $word);
            }
        endforeach;     
        
        return $matchedWords;
    }
		
}z