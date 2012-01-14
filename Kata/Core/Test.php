<?php

namespace Kata\Core;

class Test {

    private $_name;
    private $_expectedResult;
    private $_args;
    private $_assertion;

    public function __construct($name, $expectedResult, $args, $assertion='equal') {
        
        if (!is_array($args)) {
            throw new Exception("Arguments must be an array");
        }
        
        $this->_name = $name;
        $this->_expectedResult = $expectedResult;
        $this->_args = $args;
        $this->_assertion = $assertion;
    }

    /**
     * Get arguments to be passed to function being tested.
     * 
     * @return array
     */
    public function getArgs() {
        return $this->_args;
    }

    /**
     * @return mixed
     */
    public function getExpectedResult() {
        return $this->_expectedResult;
    }

    /**
     * Test the result against what was expected.
     * 
     * @param mixed $result
     * @return bool 
     */
    public function checkResult($result) {
        switch ($this->_assertion):
            case "equals":
                return ($result == $this->_expectedResult);
            default:
                throw new Exception("Unknown assertion: $this->assertion");
        endswitch;
    }
	
	public function getResultText($result){
		if($this->checkResult($result)){
			return 'passed';
		}
		
		return '*failed* value returned was:'.$this->_varToString($result);
		
	}
	
	private function _varToString($var){
		switch(TRUE):
			case is_array($var);
				return '['.implode(", ", $var).']';
			case is_int($var):
				return (string)$var;
			case is_object($var):
				return '{'.$this->_varToString((array)$var).'}';
			default:
				return (string)$var;
		endswitch;
	}
	
    /**
     * @return string 
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * Factory method 
     * 
     * @param string $name
     * @param mixed $expectedResult
     * @param array $args
     * @param string $assertion
     * @return Test 
     */
    public static function build($name, $expectedResult, $args, $assertion='equals') {
        return new Test($name, $expectedResult, $args, $assertion);
    }

}