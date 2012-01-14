<?php

namespace Kata\Core;

/**
 * Class responsible for loading classes/methods and running tests against them.
 */
class Runner {

    /**
     *
     * @param string $className
     * @param string $methodName
     * @return  bool 
     */
    public function test($className = NULL, $methodName = NULL) {
        switch (TRUE):
            case (!$className && !$methodName):
                $this->_testAllClasses();
                break;
            case ($className && !$methodName):
                $this->_testClass($className);
                break;
            case ($className && $methodName):
                $classInstance = $this->_getKataClassInstance($className);
                $this->_testMethod($classInstance, $this->_getPublicClassMethod($classInstance, $methodName));
                break;
            default:
                throw new Exception('You cannot test a method without specifying a class');
        endswitch;

        return TRUE;
    }

    /**
     * Load an instance of a Kata class (i.e. a class contained within the Katas directory)
     * 
     * @param string $className
     * @return object
     */
    private function _getKataClassInstance($className) {
        $realClassName = "\Kata\\Katas\\" . $className;
        $kataClass = new $realClassName;
        if(FALSE === ($kataClass instanceof KataAbstract)){
            throw new Exception('Kata classes must extend KataAbstract');
        }
        return $kataClass;
    }

    /**
     * Test all classes and methods
     */
    protected function _testAllClasses() {
        foreach ($this->_getKataClasses() as $className => $fileInfo):
            $this->_testClass($className);
        endforeach;
    }

    /**
     * Get an array of all classes within the Katas directory
     * 
     * @return array
     */
    private function _getKataClasses() {
        $kataClasses = array();
        $dirIterator = new \RecursiveDirectoryIterator(APPLICATION_PATH . '/Kata/Katas');
        foreach (new \RecursiveIteratorIterator($dirIterator) as $filename => $fileInfo):
            $kataClasses[basename($filename, '.php')] = $fileInfo;
        endforeach;
        return $kataClasses;
    }

    /**
     * Test Entire Class by name
     * 
     * @param string $className
     */
    protected function _testClass($className) {
        Log::log("Testing Class $className");
        $this->_testAllMethods($this->_getKataClassInstance($className));
    }

    /**
     * Test all methods of class instance
     * 
     * @param \Kata\Core\KataAbstract $classInstance 
     */
    protected function _testAllMethods(\Kata\Core\KataAbstract $classInstance) {
        foreach ($this->_getPublicClassMethods($classInstance) as $method):
            if ($this->_getCommentTagValue($method->getDocComment(), '@enabled') != 'false') {
                $this->_testMethod($classInstance, $method);
            }
        endforeach;
    }

    /**
     * Get all public methods of a clss instance
     * 
     * @param \Kata\Core\KataAbstract $classInstance
     * @return collection of ReflectionMethod objects
     */
    private function _getPublicClassMethods(\Kata\Core\KataAbstract $classInstance) {
        $classInfo = new \ReflectionClass($classInstance);
        return $classInfo->getMethods(\ReflectionMethod::IS_PUBLIC);
    }

    /**
     * Get a single ReflectionMethod object by name
     * 
     * @param \Kata\Core\KataAbstract $classInstance
     * @param string $methodName
     * @return ReflectionMethod object 
     */
    private function _getPublicClassMethod(\Kata\Core\KataAbstract $classInstance, $methodName) {
        $classInfo = new \ReflectionClass($classInstance);
        return $classInfo->getMethod($methodName);
    }

    /**
     * Extract a tag from a DocComment block
     * 
     * @param string $docComment
     * @param string $tagName
     * @return mixed
     */
    private function _getCommentTagValue($docComment, $tagName) {
        $matches = array();
        preg_match('#' . $tagName . '(:|=)?(.*)(\r\n|\r|\n)#U', $docComment, $matches);
        if (isset($matches[2])) {
            return trim($matches[2]);
        }
        return FALSE;
    }

    /**
     * Run all tests against method. Log Results to console.
     * 
     * @param \Kata\Core\KataAbstract $classInstance
     * @param \ReflectionMethod $method 
     */
    protected function _testMethod(\Kata\Core\KataAbstract $classInstance, \ReflectionMethod $method) {
        Log::log("Testing Method " . $method->getName());
        $mStartTime = microtime(TRUE);
        foreach ($classInstance->getTestSuite() as $test):
           $result = $method->invokeArgs($classInstance, $test->getArgs());
            Log::log($test->getName() . " " . $test->getResultText($result));
        endforeach;
        $mEndTime = microtime(TRUE);
        Log::log('Completed all tests in ' . ($mEndTime - $mStartTime) . 's');
    }
	
}