<?php

namespace Kata\Tests;

/**
 * Example test suite for BinarySearch Katas
 * Test suites do not need to be defined as a class, you could just create the suite in _setUp
 */
class BinSearch extends \Kata\Core\TestSuite {

    public function __construct() {
        //name, expected result, method arguments (in this case haystack, needle)
        $this->addTest(\Kata\Core\Test::build("t1.1", FALSE, array(array(), 3)));
        $this->addTest(\Kata\Core\Test::build("t1.2", FALSE, array(array(1), 3)));
        $this->addTest(\Kata\Core\Test::build("t1.3", 0, array(array(1), 1)));

        $this->addTest(\Kata\Core\Test::build("t2.1", 0, array(array(1, 3, 5), 1)));
        $this->addTest(\Kata\Core\Test::build("t2.2", 1, array(array(1, 3, 5), 3)));
        $this->addTest(\Kata\Core\Test::build("t2.3", 2, array(array(1, 3, 5), 5)));
        $this->addTest(\Kata\Core\Test::build("t2.4", FALSE, array(array(1, 3, 5), 0)));
        $this->addTest(\Kata\Core\Test::build("t2.5", FALSE, array(array(1, 3, 5), 2)));
        $this->addTest(\Kata\Core\Test::build("t2.6", FALSE, array(array(1, 3, 5), 4)));
        $this->addTest(\Kata\Core\Test::build("t2.7", FALSE, array(array(1, 3, 5), 6)));

        $this->addTest(\Kata\Core\Test::build("t3.1", 0, array(array(1, 3, 5, 7), 1)));
        $this->addTest(\Kata\Core\Test::build("t3.2", 1, array(array(1, 3, 5, 7), 3)));
        $this->addTest(\Kata\Core\Test::build("t3.3", 2, array(array(1, 3, 5, 7), 5)));
        $this->addTest(\Kata\Core\Test::build("t3.4", 3, array(array(1, 3, 5, 7), 7)));
        $this->addTest(\Kata\Core\Test::build("t3.5", FALSE, array(array(1, 3, 5, 7), 0)));
        $this->addTest(\Kata\Core\Test::build("t3.6", FALSE, array(array(1, 3, 5, 7), 2)));
        $this->addTest(\Kata\Core\Test::build("t3.7", FALSE, array(array(1, 3, 5, 7), 4)));
        $this->addTest(\Kata\Core\Test::build("t3.8", FALSE, array(array(1, 3, 5, 7), 6)));
        $this->addTest(\Kata\Core\Test::build("t3.9", FALSE, array(array(1, 3, 5, 7), 8)));
    }
}