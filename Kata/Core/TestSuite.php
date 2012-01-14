<?php

namespace Kata\Core;

class TestSuite implements \Iterator {

    private $_position = 0;
    private $_tests = array();

    public function current() {
        return $this->_tests[$this->_position];
    }

    public function key() {
        return $this->_position;
    }

    public function next() {
        ++$this->_position;
    }

    public function rewind() {
        $this->_position = 0;
    }

    public function valid() {
        return isset($this->_tests[$this->_position]);
    }

    public function addTest(Test $test) {
        $this->_tests[] = $test;
    }

}