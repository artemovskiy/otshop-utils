<?php

namespace Xydens\OtShopUtils;

use OtShop\Support\Eject\AbstractTask;

class MakeDirTask extends AbstractTask {

    /**
     * @var string
     */
    protected $path;

    public function run() {
        if (is_dir($this->path)) {
            $this->getOutput()->writeln("Ignoring mkdir {$this->path}");

            return true;
        }
        mkdir($this->path);
        $this->getOutput()->writeln("Made dir: {$this->path}");

        return true;
    }

    public function path($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

}