<?php

namespace Broskees\AcfSeparateConcerns\Console;

use Log1x\AcfComposer\Console\MakeCommand as MakeCommandBase;
use Illuminate\Support\Str;

trait MakeCommandTrait
{
    protected function getPath($name) {
        $acf_path = apply_filters('acf_composer_path', defined('WP_CONTENT_DIR')
            ? WP_CONTENT_DIR.DIRECTORY_SEPARATOR.'acf'
            : ''
        );

        if (empty($acf_path)) {
            return parent::getPath($name);
        }

        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return sprintf(
            '%s/%s.php',
            $acf_path,
            str_replace('\\', '/', $name)
        );
    }
}
