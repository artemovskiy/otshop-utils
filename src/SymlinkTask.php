<?php

namespace Xydens\OtShopUtils;

use OtShop\Support\Eject\AbstractTask;

class SymlinkTask extends AbstractTask {

    /** @var string */
    protected $target;

    /** @var string */
    protected $to;

    public function run() {
        if (!file_exists($this->target)) {
            throw new \RuntimeException("Target \"{$this->target}\" for symlink does not exist!");
        }
        if (file_exists($this->to)) {
            if (is_link($this->to)) {
                $this->getOutput()->writeln("Ignoring symlink {$this->to}");

                return true;
            } else {
                throw new \RuntimeException("Can not create link to \"{$this->to}\". File already exists!");
            }
        }
        symlink(realpath($this->target), $this->to);
        $this->getOutput()->writeln("Make symlink: \"{$this->target}\" -> \"{$this->to}\"");

        return true;
    }

    /**
     * @param $target string
     * @return $this
     */
    public function target($target) {
        $this->target = $target;

        return $this;
    }

    /**
     * @param $to string
     * @return $this
     */
    public function to($to) {
        $this->to = $to;

        return $this;
    }

}