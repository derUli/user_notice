<?php

class UserNoticeDataTest extends \PHPUnit\Framework\TestCase {

    const originalString = "<p>test<script>alert('xss')</script></p>";
    const filteredString = "<p>testalert('xss')</p>";

    private $user;

    public function setUp() {
        $user = new User();
        $user->setUsername("test_user");
        $user->setFirstname("Max");
        $user->setLastname("Muster");
        $user->setGroupId(1);
        $user->setPassword("password123");
        $user->setLocked(1);
        $user->save();

        $this->user = $user;
    }

    public function tearDown() {
        $sql = "update {prefix}users set notice = ? where notice = ? or notice = ?";
        $args = array(
            null,
            self::originalString,
            self::filteredString
        );
        Database::pQuery($sql, $args, true);

        $this->user->delete();
    }

    public function testSetUserNotice() {
        $user = new UserNoticeData ();
        $user->loadByUsername("test_user");
        $this->assertNotNull($user->getId());
        $this->assertNull($user->getNotice());
        $user->setNotice(self::originalString);
        $this->assertEquals(self::filteredString, $user->getNotice());
        $user->save();

        $user = new UserNoticeData ();
        $user->loadByUsername("test_user");
        $this->assertEquals(self::filteredString, $user->getNotice());
        $user->setNotice("  ");
        $this->assertNull($user->getNotice());
        $user->save();
        $user = new UserNoticeData ();
        $user->loadByUsername("test_user");
        $this->assertNull($user->getNotice());

        $user->setNotice("test");
        $user->save();
        $user = new UserNoticeData ();
        $user->loadByUsername("test_user");
        $this->assertEquals("test", $user->getNotice());
        $user->setNotice(null);
        $user->save();
        $user = new UserNoticeData ();
        $user->loadByUsername("test_user");
        $this->assertNull($user->getNotice());
    }

    public function testLoadByIdExists() {
        $user = new UserNoticeData($this->user->getId());
        $this->assertTrue($user->isPersistent());
        $user->setNotice(self::originalString);
        $user->save();

        $updatedUser = new UserNoticeData($this->user->getId());
        $this->assertEquals(self::filteredString, $updatedUser->getNotice());
    }

    public function testLoadByIdNotExisting() {
        $user = new UserNoticeData ();
        $user->loadByUsername("gibts_nicht");
        $this->assertFalse($user->isPersistent());
        $this->assertNull($user->getNotice());
    }

    public function testCreateUserNotice() {
        $user = new UserNoticeData();
        $user->setUsername("test_user2");
        $user->setFirstname("Max");
        $user->setLastname("Muster");
        $user->setGroupId(1);
        $user->setPassword("password123");
        $user->setLocked(1);
        $user->setNotice(self::originalString);
        $user->save();

        $this->assertEquals(self::filteredString, $user->getNotice());

        $user->delete();
    }

}
