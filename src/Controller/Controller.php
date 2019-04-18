<?php

namespace Drupal\sitename_changer\Controller;

use Drupal\Core\Controller\ControllerBase;

class Controller extends ControllerBase {
    public function myPage() {
        $element = array(
            '#markup' => 'Hello, World',
        );
        return $element;
    }
}