<?php

require_once("../models/npos.php");


class Model_Npo_Test extends WP_UnitTestCase
{
    /**
     * Setup db doing a delta
     *
     */
    public static function setUpBeforeClass()
    {
        global $wpdb;
        $wpdb->suppress_errors = false;
        $wpdb->show_errors = true;
        ini_set('display_errors', 1 );


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $sql=model_thehub_npos::get_create_table();
        dbDelta($sql);

        // truncate data
        $wpdb->query("TRUNCATE ".model_thehub_npos::get_table_name());
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
        $npo = new model_thehub_npos();
        $this->assertInstanceOf('model_thehub_npos', $npo);
    }

    /**
     *
     */
    public function test_basics()
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
    public function test_validate_fail()
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
    public function test_validate_ok()
    {
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

    /**
     * Test adding a row
     *
     */
    public function test_save()
    {
        // check no data
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 0);

        // load data
        $npo=$this->helper_valid_npo();

        // assert

        $this->assertTrue($npo->is_new());

        $npo->save();
        $this->assertFalse($npo->is_new());
        $this->assertFalse($npo->is_active());

        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 1);

        // toggle active stats
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_deactive, 1);
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_active, 0);

        $npo->set_active();
        $this->assertTrue($npo->is_active());
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_deactive, 0);
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_active, 1);

        $npo->set_active(False);
        $this->assertFalse($npo->is_active());

        // test updates
        $npo->save();
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 1);

        $npo->save();
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 1);
    }

    /**
     * Test loading
     *
     */
    function test_load()
    {
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 0);

        // no test data so return new
        $npo=model_thehub_npos::get_by_email("test@test.com");
        $this->assertNotInstanceOf("model_thehub_npos", $npo);
        unset($npo);

        // add test data
        $npo=$this->helper_valid_npo();
        $npo->save();
        unset($npo);

        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 1);

        // get by email again
        $npo=model_thehub_npos::get_by_email("test@test.com");
        $this->assertInstanceOf("model_thehub_npos", $npo);

        // get by id
        $npo_2=model_thehub_npos::get_by_id($npo->id);
        $this->assertInstanceOf("model_thehub_npos", $npo_2);
        $this->assertEquals($npo->id, $npo_2->id);
    }

    /**
     * Test updates
     *
     */
    public function test_updates()
    {
        $npo=$this->helper_valid_npo();
        $npo->save();

        $npo->Name="New name";
        $npo->save();

        $npo_2=model_thehub_npos::get_by_id($npo->id);
        $this->assertEquals($npo->id, $npo_2->id); // same npo
        $this->assertEquals("New name", $npo_2->Name);
    }

    /**
     *
     */
    public function test_search()
    {
        // create tests
        $npo_test = $this->helper_valid_npo();
        $npo_test->save();

        $npo_dog = $this->helper_valid_npo();
        $npo_dog->Name="Friends of the dog";
        $npo_dog->set_active();
        $npo_dog->save();

        $npo_cat = $this->helper_valid_npo();
        $npo_cat->Name="Friends of the cat";
        $npo_cat->set_active();
        $npo_cat->save();

        $npo_kids = $this->helper_valid_npo();
        $npo_kids->Name="Helping children";
        $npo_kids->set_active();
        $npo_kids->save();

        $npo_old = $this->helper_valid_npo();
        $npo_old->Name="Loving old folk";
        $npo_old->set_active();
        $npo_old->save();

        // test stats
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_all, 5);
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_active, 4);
        $this->assertEquals(model_thehub_npos::get_table_stats()->count_deactive, 1);

        //---

        $search=model_thehub_npos::get_by_name($name_like="dog");
        $this->assertEquals(1, sizeof($search));

        $search=model_thehub_npos::get_by_name($name_like="Friends of");
        $this->assertEquals(2, sizeof($search));

        // search for inactive
        $search=model_thehub_npos::get_by_name($name_like="TEST",$filter_service=Null, $active=False);
        $this->assertEquals(1, sizeof($search));
        $search=model_thehub_npos::get_by_name($name_like="TEST",$filter_service=Null, $active=Null);
        $this->assertEquals(1, sizeof($search));
        $search=model_thehub_npos::get_by_name($name_like="TEST",$filter_service=Null, $active=True);
        $this->assertEquals(0, sizeof($search));
    }


    /**
     * @return model_thehub_npos
     *
     */
    function helper_valid_npo()
    {
        $npo = new model_thehub_npos();

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

        return $npo;
    }
}