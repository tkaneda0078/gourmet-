<?php
/**
 * Model Post class tests
 * 
 * @group Model
 * @group Member
 */

class Test_Model_Gnavi_Data extends \TestCase
{
  public function test_create_member(){
    $count = count(Model_Gnavi_Data::find("all"));

    $member = Model_Gnavi_Data::forge(array(
      'name' => "name",
      'area' => 'area',
    ));

    $member->save();

    $update_count = count(Model_Gnavi_Data::find("all"));

    $this->assertEquals($count+1,$update_count);

  }
}