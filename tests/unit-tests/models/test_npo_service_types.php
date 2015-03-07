<?php

class Model_Npo_Service_Types_Test extends WP_UnitTestCase
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
        $npo_service = new model_thehub_npo_service_types();
        $this->assertInstanceOf('model_thehub_npo_service_types', $npo_service);
    }

    /**
     *
     */
    public function test_basics()
    {
        $npo_service = new model_thehub_npo_service_types();
        $this->assertInstanceOf('model_thehub_npo_service_types', $npo_service);

        $this->assertTrue($npo_service->is_new());

        $this->assertEquals(Null, $npo_service->Service);

        // update an attribute
        $npo_service->set_data(array("Service" => "This is a test"));
        $this->assertEquals("This is a test", $npo_service->Service);

        // we do not want add a none attribute
        $npo_service->set_data(array("Dummy" => "Do not set"));
        $this->assertObjectNotHasAttribute("Dummy", $npo_service);
    }

    /**
     *
     */
    public function test_validate_fail()
    {
        $npo_service = new model_thehub_npo_service_types();

        // check default validation, must fail
        $this->assertEquals($npo_service->validate(), False); // must fail
        $this->assertNotEmpty($npo_service->validation_errors); // must have errors

        $npo_service = helper_models::empty_npo_service_types($npo_service);
        $this->assertEquals($npo_service->validate(), False); // must fail
        $this->assertArrayHasKey("Service", $npo_service->validation_errors);
    }

    /**
     *
     */
    public function test_validate_pass()
    {
        $npo_service = helper_models::valid_npo_service_types();
        $this->assertEquals($npo_service->validate(), True); // must fail
        $this->assertArrayNotHasKey("Service", $npo_service->validation_errors);

    }

    /**
     *
     */
    public function test_active()
    {
        $npo = new model_thehub_npo_service_types();
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
        $count_all=model_thehub_npo_service_types::get_table_stats()->count_all;
        $count_active=model_thehub_npo_service_types::get_table_stats()->count_active;
        $count_deactive=model_thehub_npo_service_types::get_table_stats()->count_deactive;

        // check no data
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all); //0
        $npo_service=helper_models::valid_npo_service_types();

        // assert

        $this->assertTrue($npo_service->is_new());

        $npo_service->save();
        $this->assertFalse($npo_service->is_new());
        $this->assertFalse($npo_service->is_active());

        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+1); // 1

        // toggle active stats
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_active, $count_active+0);
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_deactive, $count_deactive+1);

        $npo_service->set_active(True);
        $this->assertTrue($npo_service->is_active());
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_active, $count_active+1);
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_deactive, $count_deactive+0);

        $npo_service->set_active(False);
        $this->assertFalse($npo_service->is_active());
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_active, $count_active+0);
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_deactive, $count_deactive+1);

        // test updates
        $npo_service->save();
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+1);

        $npo_service->save();
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+1);
    }

    /**
     * Test loading
     *
     */
    function test_load()
    {
        $count_all=model_thehub_npo_service_types::get_table_stats()->count_all;
        $count_active=model_thehub_npo_service_types::get_table_stats()->count_active;
        $count_deactive=model_thehub_npo_service_types::get_table_stats()->count_deactive;

        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+0); //0

        // no test data so return new
        $npo_service=model_thehub_npo_service_types::get_by_service("Test service");
        $this->assertNotInstanceOf("model_thehub_npo_service_types", $npo_service);
        unset($npo_service);

        // add test data
        $npo_service=helper_models::valid_npo_service_types();
        $npo_service->set_active();
        $npo_service->save();
        unset($npo_service);

        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+1);

        // get by service again
        $npo_services=model_thehub_npo_service_types::get_by_service("Test service");
        $this->assertEquals(1, sizeof($npo_services));
        list($npo_service)=$npo_services;
        $this->assertInstanceOf("model_thehub_npo_service_types", $npo_service);


        // get by id
        $npo_service_2=model_thehub_npo_service_types::get_by_id($npo_service->id);
        $this->assertInstanceOf("model_thehub_npo_service_types", $npo_service_2);
        $this->assertEquals($npo_service->id, $npo_service_2->id);

        // invalid id
        $npo_service_3=model_thehub_npo_service_types::get_by_id(Null);
        $this->assertNotInstanceOf("model_thehub_npo_service_types", $npo_service_3);
        $npo_service_4=model_thehub_npo_service_types::get_by_id(99999);
        $this->assertNotInstanceOf("model_thehub_npo_service_types", $npo_service_4);
    }

    /**
     * Test updates
     *
     */
    public function test_updates()
    {
        $npo_service=helper_models::valid_npo_service_types();
        $npo_service->save();

        $npo_service->Service="New service name";
        $npo_service->save();

        $npo_service_2=model_thehub_npo_service_types::get_by_id($npo_service->id);
        $this->assertEquals($npo_service->id, $npo_service_2->id);
        $this->assertEquals("New service name", $npo_service_2->Service);
    }

    /**
     *
     */
    public function test_search()
    {
        $count_all=model_thehub_npo_service_types::get_table_stats()->count_all;
        $count_active=model_thehub_npo_service_types::get_table_stats()->count_active;
        $count_deactive=model_thehub_npo_service_types::get_table_stats()->count_deactive;

        // create tests
        $npo_service=helper_models::valid_npo_service_types();
        $npo_service->save();

        $npo_service_animals=helper_models::valid_npo_service_types();
        $npo_service_animals->Service="Service abused animals";
        $npo_service_animals->set_active();
        $npo_service_animals->save();

        $npo_service_rescue=helper_models::valid_npo_service_types();
        $npo_service_rescue->Service="Service rescue animals";
        $npo_service_rescue->set_active();
        $npo_service_rescue->save();

        $npo_service_fet=helper_models::valid_npo_service_types();
        $npo_service_fet->Service="Service FET";
        $npo_service_fet->set_active();
        $npo_service_fet->save();


        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_all, $count_all+4); // 4
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_active, $count_active+3);
        $this->assertEquals(model_thehub_npo_service_types::get_table_stats()->count_deactive,  $count_deactive+1);

        // search

        $search=model_thehub_npo_service_types::get_by_service($name_like="rescue");
        $this->assertEquals(1, sizeof($search));

        $search=model_thehub_npo_service_types::get_by_service($name_like="animals");
        $this->assertEquals(1+2, sizeof($search));

        $search=model_thehub_npo_service_types::get_by_service($name_like="test");
        $this->assertEquals(0, sizeof($search));

        $search=model_thehub_npo_service_types::get_by_service($name_like="test", $active=False);
        $this->assertEquals(1, sizeof($search));
        $search=model_thehub_npo_service_types::get_by_service($name_like="test", $active=Null);
        $this->assertEquals(1, sizeof($search));
    }

}
// [eof]