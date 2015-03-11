<?php

class Model_Businesses_Test extends WP_UnitTestCase
{

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        TheHubSA(); // init class
    }

    /**
     * Tear down
     */
    public function tearDown()
    {

    }

    /**
     * Test
     */
    public function test_001()
    {
        $this->assertEquals("cow", "cow");
    }

    /**
     *
     */
    public function test_init()
    {
        $business=new model_thehub_businesses();
        $this->assertInstanceOf('model_thehub_businesses', $business);
    }

    /**
     *
     */
    public function test_basics()
    {
        $business=new model_thehub_businesses();
        $this->assertInstanceOf('model_thehub_businesses', $business);

        $this->assertTrue($business->is_new());

        $this->assertEquals(Null, $business->Name);

        // update an attribute
        $business->set_data(array("Name"=>"This is a test"));
        $this->assertEquals("This is a test", $business->Name);

        // we do not want add a none attribute
        $business->set_data(array("Dummy"=>"Do not set"));
        $this->assertObjectNotHasAttribute("Dummy" ,$business);
    }

    /**
     * Validation: fail
     *
     */
    public function test_validate_fail()
    {
        $business = new model_thehub_businesses();

        // check default validation, must fail
        $this->assertEquals($business->validate(), False); // must fail
        $this->assertNotEmpty($business->validation_errors); // must have errors

        $business=helper_models::empty_npo($business);
        $this->assertEquals($business->validate(), False); // must fail


        // test individual failures ...

        // payment error
        $business->paymentEft = Null;
        $business->paymentDeposit = Null;
        $this->assertArrayHasKey("paymentEft", $business->validation_errors);
        $this->assertArrayHasKey("paymentDeposit", $business->validation_errors);

        // email errors

        $business->Email="test";
        $this->assertEquals($business->validate(), False);
        $this->assertArrayHasKey("Email", $business->validation_errors);

        $business->Email="test@test";
        $this->assertEquals($business->validate(), False);
        $this->assertArrayHasKey("Email", $business->validation_errors);

        $business->Email="test.com";
        $this->assertEquals($business->validate(), False);
        $this->assertArrayHasKey("Email", $business->validation_errors);

        $business->Email="@test.com";
        $this->assertEquals($business->validate(), False);
        $this->assertArrayHasKey("Email", $business->validation_errors);
    }

    /**
     * Validation: ok
     *
     */
    public function test_validate_ok()
    {
        $business = new model_thehub_businesses();
        helper_models::valid_business($business);

        $this->assertEquals($business->validate(), True);


        // payment validation
        $business->paymentEft = True;
        $business->paymentDeposit = Null;
        $business->validate();
        $this->assertArrayNotHasKey("paymentEft", $business->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $business->validation_errors);

        $business->paymentEft = Null;
        $business->paymentDeposit = True;
        $business->validate();
        $this->assertArrayNotHasKey("paymentEft", $business->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $business->validation_errors);

        $business->paymentEft = True;
        $business->paymentDeposit = True;
        $business->validate();
        $this->assertArrayNotHasKey("paymentEft", $business->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $business->validation_errors);
    }

    /**
     *
     */
    public function test_active()
    {
        $business=new model_thehub_npos();
        $this->assertFalse($business->is_active());

        $business->set_active();
        $this->assertTrue($business->is_active());

        // save
        $business->save();
        $this->assertTrue($business->is_active());
        // update
        $business->save();
        $this->assertTrue($business->is_active());

//        $business_2=model_thehub_npos::get_by_id($business->id);
//        $this->assertTrue($business_2->is_active());
    }

}