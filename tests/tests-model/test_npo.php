<?php

require_once("../models/npos.php");

class Model_Npo_Test extends WP_UnitTestCase
{
    function test_001()
    {
        $this->assertEquals("cow", "cow");
    }
}