<?php

require_once("../models/npos.php");

class helper_models
{

    /**
     * @return model_thehub_npos
     */
    static public function empty_npo($npo = Null)
    {
        if ($npo instanceof model_thehub_npos == False) {
            $npo = new model_thehub_npos();
        }

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

        return $npo;
    }

    /**
     * @return model_thehub_npos
     *
     */
    static public function valid_npo($npo = Null)
    {
        if ($npo instanceof model_thehub_npos == False) {
            $npo = new model_thehub_npos();
        }

        $npo->Name = "Test";
        $npo->RegNumber = "1234567890";
//        $npo->RegNumberOther=Null;
        $npo->Address = "1 Test road, testville";
        $npo->AddressPostal = "1 testbox";
        $npo->Contact = "Mr Test";
        $npo->Tel = "0218501234";
        $npo->Mobile = "0821231234";
        $npo->Email = "test@test.com";
        $npo->wwwDomain = "http://test.com";
        $npo->wwwHomepage = "http://test.com/test";
        $npo->wwwFacebook = "/test";
        $npo->Description = "This is a unit test";
        $npo->ServicesOffered = "We offer testing";
//        $npo->AssociatedOrganisations=Null;
        $npo->listNeeds = "We need more tests";
        $npo->listWish = "We wish for more tests";
        $npo->paymentEft = True;
//        $npo->paymentDeposit=Null;
        $npo->Notes = "Test test test";
        $npo->LogoPath = Null;

        return $npo;
    }

    /**
     * @param null $npo_service
     * @return model_thehub_npo_service_types|null
     */
    static public function empty_npo_service_types($npo_service = Null)
    {
        if ($npo_service instanceof model_thehub_npo_service_types == False) {
            $npo_service = new model_thehub_npo_service_types();
        }
        $npo_service->id=Null;
        $npo_service->Service=Null;
        $npo_service->bActive=Null;
        return $npo_service;
    }

    /**
     * @param null $npo_service
     * @return model_thehub_npo_service_types|null
     */
    static public function valid_npo_service_types($npo_service = Null)
    {
        if ($npo_service instanceof model_thehub_npo_service_types == False) {
            $npo_service = new model_thehub_npo_service_types();
        }
//        $npo_service->id=Null;
        $npo_service->Service="Test Service";
//        $npo_service->bActive=Null;
        return $npo_service;
    }
}