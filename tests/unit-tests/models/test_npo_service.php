<?php

class Model_Npo_Services_Test extends WP_UnitTestCase
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
        $npo_services = new model_thehub_npo_services();
        $this->assertInstanceOf('model_thehub_npo_services', $npo_services);
    }

    /**
     *
     */
    public function test_basics()
    {
        $npo_services=new model_thehub_npo_services();
        $this->assertInstanceOf('model_thehub_npo_services', $npo_services);

        // $this->assertTrue($npo->is_new());

        $this->assertEquals(Null, $npo_services->ServiceOther);

        // update an attribute
        $npo_services->set_data(array("ServiceOther"=>"This is a test"));
        $this->assertEquals("This is a test", $npo_services->ServiceOther);

        // we do not want add a none attribute
        $npo_services->set_data(array("Dummy"=>"Do not set"));
        $this->assertObjectNotHasAttribute("Dummy" ,$npo_services);
    }

    /**
     * Validation: fail
     *
     */
    public function test_validate_fail()
    {
        $npo_services = new model_thehub_npo_services();

        $this->assertEquals($npo_services->validate(), False); // must fail
        $this->assertNotEmpty($npo_services->validation_errors); // must have errors

        $this->assertArrayHasKey("fkNpo", $npo_services->validation_errors);
        $this->assertArrayHasKey("general", $npo_services->validation_errors);
    }

    /**
     *
     */
    public function test_validate_ok()
    {
        $npo_services = new model_thehub_npo_services();
        $npo_services->fkNpo=12345;
        $npo_services->validate();
        $this->assertArrayNotHasKey("fkNpo", $npo_services->validation_errors);

        $npo_services->fkService=12345;
        $npo_services->ServiceOther=Null;
        $npo_services->validate();
        $this->assertArrayNotHasKey("general", $npo_services->validation_errors);

        $npo_services->fkService=Null;
        $npo_services->ServiceOther="Test";
        $npo_services->validate();
        $this->assertArrayNotHasKey("general", $npo_services->validation_errors);

        $npo_services->fkService=12345;
        $npo_services->ServiceOther="Test";
        $npo_services->validate();
        $this->assertArrayNotHasKey("general", $npo_services->validation_errors);
    }

    /**
     *
     */
    public function test_active()
    {
        $npo_services=new model_thehub_npos();
        $this->assertFalse($npo_services->is_active());

        $npo_services->set_active();
        $this->assertTrue($npo_services->is_active());
    }

    /**
     * Test adding a row
     *
     */
    public function test_save_and_load()
    {
        $npo=helper_models::valid_npo();
        $npo->save();

        // setup services
        $service_1=helper_models::valid_npo_service_types();
        $service_1->save();

        $service_2=helper_models::valid_npo_service_types();
        $service_2->save();

        $service_3=helper_models::valid_npo_service_types();
        $service_3->save();

        //
        $npo_services_1=new model_thehub_npo_services();
        $npo_services_1->fkNpo=$npo->id;
        $npo_services_1->fkService=$service_1->id;
        $this->assertTrue($npo_services_1->validate());
        $npo_services_1->set_active();
        $npo_services_1->save();

        $npo_services_2=new model_thehub_npo_services();
        $npo_services_2->fkNpo=$npo->id;
        $npo_services_2->fkService=$service_2->id;
        $this->assertTrue($npo_services_2->validate());
        $npo_services_2->set_active();
        $npo_services_2->save();

        $npo_services_3=new model_thehub_npo_services();
        $npo_services_3->fkNpo=$npo->id;
        $npo_services_3->fkService=$service_3->id;
        $this->assertTrue($npo_services_3->validate());
        $npo_services_3->set_active();
        $npo_services_3->save();

        $npo_services_4=new model_thehub_npo_services();
        $npo_services_4->fkNpo=$npo->id;
        $npo_services_4->ServiceOther="This is a test";
        $this->assertTrue($npo_services_4->validate());
        $npo_services_4->set_active();
        $npo_services_4->save();

        //-- test load
        $this->assertEquals(4, sizeof($npo->get_npo_services()));

        $npo_new=model_thehub_npos::get_by_id($npo->id);
        $this->assertEquals(4, sizeof($npo_new->get_npo_services()));
        foreach($npo_new->get_npo_services() as $services) {
            $this->assertTrue($services->validate());
        }

        //-- test update
        $npo_services_4->save();
        $npo_services_4->save();
        $npo_services_4->save();
        $npo_services_4->save();

        $this->assertEquals(4, sizeof($npo->get_npo_services()));
        $this->assertEquals(8, sizeof($npo->get_npo_services(True))); // after refresh

        // -- delete
        $npo2=helper_models::valid_npo();
        $npo2->save();
        $npo_services_4->fkNpo=$npo2->id;
        $npo_services_4->save();
        $npo_services_4->save();
        $npo_services_4->save();
        $this->assertEquals(3, sizeof($npo2->get_npo_services(True)));

        model_thehub_npo_services::delete_by_npo($npo2->id);
        $this->assertEquals(0, sizeof($npo2->get_npo_services(True)));

        // check we have not delete other records
        $this->assertEquals(8, sizeof($npo->get_npo_services(True)));

        // update again
        $npo_services_4->save();
        $this->assertEquals(1, sizeof($npo2->get_npo_services(True)));
    }

}

// [eof]