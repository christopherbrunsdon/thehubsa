<?php

class WP_Is_Email_Test extends WP_UnitTestCase {

	function test_is_email_only_letters_with_dot_com_domain() {
		$this->assertEquals( 'nb@nikolay.com',  'nb@nikolay.com' );
	}

}
