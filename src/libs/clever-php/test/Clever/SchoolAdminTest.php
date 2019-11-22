<?php

class CleverSchoolAdminTest extends UnitTestCase
{
  public function testUrl()
  {
    $this->assertEqual(CleverSchoolAdmin::classUrl('CleverSchoolAdmin'), '/school_admins');
  }

  public function testAll()
  {
    authorizeFromEnv();
    $admins = CleverSchoolAdmin::all();
    foreach ($admins as $admin) {
      $this->assertEqual(get_class($admin), "CleverSchoolAdmin");
      $this->assertEqual($admin->instanceUrl(), "/school_admins/" . $admin->id);
      $adminBefore = clone($admin);
      $admin->refresh();
      $this->assertEqual($adminBefore, $admin);
    }
  }

  public function testAllLimit()
  {
    authorizeFromEnv();
    $admins = CleverSchoolAdmin::all(array("limit"=>1));
    $this->assertEqual(count($admins),1);
  }

  public function testSecondLevel()
  {
    $admins = CleverSchoolAdmin::all(array('limit'=>1));
    $admin = $admins[0];
    $secondLevelTests = array('schools' => 'CleverSchool');

    foreach ($secondLevelTests as $k => $v) {
      $objs = $admin->$k();
      foreach ($objs as $obj) {
        $this->assertEqual(get_class($obj), $v);
        if ($k != "events") {
          $this->assertEqual($obj->instanceUrl(), '/' . $k . '/' . $obj->id);
        } else {
          $this->assertEqual($obj->instanceUrl(), '/push/' . $k . '/' . $obj->id);
        }
      }
    }
  }
}
