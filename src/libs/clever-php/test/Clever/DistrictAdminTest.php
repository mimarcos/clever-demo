<?php

class CleverDistrictAdminTest extends UnitTestCase
{
  public function testUrl()
  {
    $this->assertEqual(CleverDistrictAdmin::classUrl('CleverDistrictAdmin'), '/district_admins');
  }

  public function testAll()
  {
    authorizeFromEnv();
    $admins = CleverDistrictAdmin::all();

    foreach ($admins as $admin) {
      $this->assertEqual(get_class($admin), "CleverDistrictAdmin");
      $this->assertEqual($admin->instanceUrl(), "/district_admins/" . $admin->id);
      $adminBefore = clone($admin);
      $admin->refresh();
      $this->assertEqual($adminBefore, $admin);
    }
  }
}
