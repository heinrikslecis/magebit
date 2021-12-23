<?php

namespace App\Libraries;

/*
 * App Core Class
 * Creates URL & loads core controller
 */
class Core
{
  protected $currentController = "EmailController";
  protected $currentMethod = "index";
  protected $params = [];

  public function __construct()
  {
    $url = $this->getUrl();

    // Require the controller
    $controllerObject = "App\Controllers\\" . $this->currentController;

    // Instantiate controller class
    $this->currentController = new $controllerObject();

    // Check for second part of url
    if (isset($url[0])) {
      // Check to see if method exists in controller
      if (method_exists($this->currentController, $url[0])) {
        $this->currentMethod = $url[0];
        // Unset 1 index
        unset($url[0]);
      }
    }

    // Get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array(
      [$this->currentController, $this->currentMethod],
      $this->params
    );
  }

  public function getUrl()
  {
    if (isset($_GET["url"])) {
      $url = rtrim($_GET["url"], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      return $url;
    }
  }
}