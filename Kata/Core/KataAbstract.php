<?php

namespace Kata\Core;
/**
 * Kata class base class.
 */
abstract class KataAbstract {

    /**
     * @var \Kata\Core\TestSuite 
     */
    private $_testSuite;

    /**
     * This method should be overridden by the subclass to perform test set-up
     * 
     * @return bool
     */
    protected function _setUp() {
        return TRUE;
    }

    /**
     * @enabled false
     */
    public function __construct() {
        $this->_setUp();
    }

    /**
     * Add a test Suite to the class
     * 
     * @return \Kata\Core\TestSuite object
     * @enabled false
     */
    public function setTestSuite(TestSuite $testSuite) {
        $this->_testSuite = $testSuite;
    }

    /**
     * @return null
     * @enabled false
     */
    public function getTestSuite() {
        return $this->_testSuite;
    }

}