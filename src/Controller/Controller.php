<?php

namespace Drupal\sitename_changer\Controller;

use Drupal\Core\Controller\ControllerBase;

class Controller extends ControllerBase {
    public function test() {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Test'),
        ];
    }
}