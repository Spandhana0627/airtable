<?php

namespace Drupal\video_library\Controller;

class VideoLibraryController {
    public function message() {
        return [
            '#markup' => 'Hello World message from custom module'
        ];
    }
}