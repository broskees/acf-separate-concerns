<?php

namespace Broskees\AcfSeparateConcerns;

use Log1x\AcfComposer\AcfComposer as AcfComposerBase;
use Roots\Acorn\Application;

class AcfComposer extends AcfComposerBase
{
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $acf_path = apply_filters('acf_composer_path', defined('WP_CONTENT_DIR')
            ? WP_CONTENT_DIR.DIRECTORY_SEPARATOR.'acf'
            : ''
        );

        if (!empty($acf_path)) {
            // unset paths
            $this->paths = [];

            // replace with acf specific path;
            $this->registerPath($acf_path);
        }
    }
}
