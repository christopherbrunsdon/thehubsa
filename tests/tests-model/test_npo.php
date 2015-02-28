<?php

require_once("../models/npos.php");

class Model_Npo_Test extends WP_UnitTestCase
{
    /**
     * Test
     */
    function test_001()
    {
        $this->assertEquals("cow", "cow");
    }

    /**
     *
     */
    function test_init()
    {
        $npo = new model_thehub_npos();
        $this->assertInstanceOf('model_thehub_npos', $npo);
    }

    /**
     *
     */
    function test_basics()
    {
        $npo=new model_thehub_npos();
        $this->assertInstanceOf('model_thehub_npos', $npo);

        $this->assertTrue($npo->is_new());

        $this->assertEquals(Null, $npo->Name);

        // update an attribute
        $npo->set_data(array("Name"=>"This is a test"));
        $this->assertEquals("This is a test", $npo->Name);

        // we do not want add a none attribute
        $npo->set_data(array("Dummy"=>"Do not set"));
        $this->assertObjectNotHasAttribute("Dummy" ,$npo);
    }
    /**
     * Validation: fail
     *
     */
    function test_validate_fail()
    {
        $npo = new model_thehub_npos();

        // check default validation, must fail
        $this->assertEquals($npo->validate(), False); // must fail
        $this->assertNotEmpty($npo->validation_errors); // must have errors

        // load with null data
        $npo->id = Null;
        $npo->Name = Null;
        $npo->RegNumber = Null;
        $npo->RegNumberOther = Null;
        $npo->Address = Null;
        $npo->AddressPostal = Null;
        $npo->Contact = Null;
        $npo->Tel = Null;
        $npo->Mobile = Null;
        $npo->Email = Null;
        $npo->wwwDomain = Null;
        $npo->wwwHomepage = Null;
        $npo->wwwFacebook = Null;
        $npo->Description = Null;
        $npo->ServicesOffered = Null;
        $npo->AssociatedOrganisations = Null;
        $npo->listNeeds = Null;
        $npo->listWish = Null;
        $npo->paymentEft = Null;
        $npo->paymentDeposit = Null;
        $npo->Notes = Null;
        $npo->LogoPath = Null;
        $npo->bActive = Null;

        $this->assertEquals($npo->validate(), False); // must fail


        // test individual failures ...

        // payment error
        $npo->paymentEft = Null;
        $npo->paymentDeposit = Null;
        $this->assertArrayHasKey("paymentEft", $npo->validation_errors);
        $this->assertArrayHasKey("paymentDeposit", $npo->validation_errors);

        // email errors

        $npo->Email="test";
        $this->assertEquals($npo->validate(), False);
        $this->assertArrayHasKey("Email", $npo->validation_errors);

        $npo->Email="test@test";
        $this->assertEquals($npo->validate(), False);
        $this->assertArrayHasKey("Email", $npo->validation_errors);

        $npo->Email="test.com";
        $this->assertEquals($npo->validate(), False);
        $this->assertArrayHasKey("Email", $npo->validation_errors);

        $npo->Email="@test.com";
        $this->assertEquals($npo->validate(), False);
        $this->assertArrayHasKey("Email", $npo->validation_errors);
    }

    /**
     * Validation: ok
     *
     */
    function test_validate_ok() {

        $npo = new model_thehub_npos();

        // load with valid data
//        $npo->id=Null;
        $npo->Name="Test";
        $npo->RegNumber="1234567890";
//        $npo->RegNumberOther=Null;
        $npo->Address="1 Test road, testville";
        $npo->AddressPostal="1 testbox";
        $npo->Contact="Mr Test";
        $npo->Tel="0218501234";
        $npo->Mobile="0821231234";
        $npo->Email="test@test.com";
        $npo->wwwDomain="http://test.com";
        $npo->wwwHomepage="http://test.com/test";
        $npo->wwwFacebook="/test";
        $npo->Description="This is a unit test";
        $npo->ServicesOffered="We offer testing";
//        $npo->AssociatedOrganisations=Null;
        $npo->listNeeds="We need more tests";
        $npo->listWish="We wish for more tests";
        $npo->paymentEft=True;
//        $npo->paymentDeposit=Null;
        $npo->Notes="Test test test";
        $npo->LogoPath=Null;
//        $npo->bActive=Null;

        $this->assertEquals($npo->validate(), True);


        // payment validation
        $npo->paymentEft = True;
        $npo->paymentDeposit = Null;
        $npo->validate();
        $this->assertArrayNotHasKey("paymentEft", $npo->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $npo->validation_errors);

        $npo->paymentEft = Null;
        $npo->paymentDeposit = True;
        $npo->validate();
        $this->assertArrayNotHasKey("paymentEft", $npo->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $npo->validation_errors);

        $npo->paymentEft = True;
        $npo->paymentDeposit = True;
        $npo->validate();
        $this->assertArrayNotHasKey("paymentEft", $npo->validation_errors);
        $this->assertArrayNotHasKey("paymentDeposit", $npo->validation_errors);
    }

    /**
     *
     */
    public function test_active()
    {
        $npo=new model_thehub_npos();
        $this->assertFalse($npo->is_active());

        $npo->set_active();
        $this->assertTrue($npo->is_active());
    }

}