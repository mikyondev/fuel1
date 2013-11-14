<?php
/**
 * User: Jerem
 * Date: 14/11/13
 * Time: 13:16
 */

class controllerTest extends \PHPUnit_Framework_TestCase{

    public function  test1(){
        $this->assertEquals(2,1+1);
    }

    public function  test2(){
        $this->assertEquals(2,1-1);
    }
}