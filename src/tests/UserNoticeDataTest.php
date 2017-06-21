<?php
class UserNoticeDataTest extends PHPUnit_Framework_TestCase {
	const originalString = "<p>test<script>alert('xss');</script></p>";
	const filteredString = "<p>test</p>";
	public function setUp() {
		$sql = "update {prefix}users set notice = ? where notice = ? or notice = ?";
		$args = array (
				null,
				self::originalString,
				self::filteredString 
		);
		Database::pQuery ( $sql, $args, true );
	}
	public function tearDown() {
		$this->setUp ();
	}
	public function testSetUserNotice() {
		$user = new UserNoticeData ();
		$user->loadByUsername ( "admin" );
		$this->assertNotNull ( $user->getId () );
		$this->assertNull ( $user->getNotice () );
		$user->setNotice ( self::originalString );
		$this->assertEquals ( self::filteredString, $user->getNotice () );
		$this->save ();
		$user = new UserNoticeData ();
		$user->loadByUsername ( "admin" );
		$this->assertEquals ( self::filteredString, $user->getNotice () );
		$user->setNotice ( "  " );
		$this->assertNull ( $user->getNotice () );
		$user->save ();
		$user = new UserNoticeData ();
		$user->loadByUsername ( "admin" );
		$this->assertNull ( $user->getNotice () );
		
		$user->setNotice ( "test" );
		$user->save ();
		$user = new UserNoticeData ();
		$user->loadByUsername ( "admin" );
		$this->assertEquals ( "test", $user->getNotice () );
		$user->setNotice ( null );
		$user->save ();
		$user = new UserNoticeData ();
		$user->loadByUsername ( "admin" );
		$this->assertNull ( $user->getNotice () );
	}
}