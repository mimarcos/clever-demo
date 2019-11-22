<?php

class CleverDistrictAdmin extends CleverApiResource
{

  public static $defaultParams = array(
      'show_links' => true,
  );

  private static $secondLevelEndpoints;

  public static function constructFrom($values, $auth=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $auth);
  }

  public static function retrieve($id, $auth=null)
  {
    $class = get_class();
    return self::_scopedRetrieve($class, $id, $auth);
  }

  public static function all($params=null, $auth=null)
  {
    $class = get_class();
    return self::_scopedAll($class, self::applyDefaultParams($params), $auth);
  }

  public static function init()
  {
    self::$secondLevelEndpoints = array();
  }
  public function __call($method, $args)
  {
    if (array_key_exists($method, self::$secondLevelEndpoints)) {
      $auth = null;
      $params = self::applyDefaultParams( $args && count($args) ? $args[0] : array() );
      $requestor = new CleverApiRequestor($this->_auth);
      $url = $this->instanceUrl() . '/' . $method;
      list($response, $auth) = $requestor->request('get', $url, $params);
      return CleverUtil::convertToCleverObject($response, $this->_auth);
    }
  }
  public static function applyDefaultParams($args = array())
  {
    if ( ! empty($args) ) {
      $args = ( is_array($args) ) ? $args : array($args);
    } else {
      $args = array();
    }
    return array_merge(self::$defaultParams, $args);
  }
}

CleverDistrictAdmin::init();
