<?php

namespace Broskees\AcfSeparateConcerns\Console;

use Log1x\AcfComposer\Console\StubPublishCommand as StubPublishCommandBase;

class StubPublishCommand extends StubPublishCommandBase
{
    public function handle()
    {
        $acf_path = apply_filters(
            'acf_composer_path',
            defined('WP_CONTENT_DIR')
                ? WP_CONTENT_DIR.DIRECTORY_SEPARATOR.'acf'
                : ''
        );

        $stubsPath = $acf_path.DIRECTORY_SEPARATOR.'stubs';

        if (! is_dir($stubsPath)) {
            (new Filesystem())->makeDirectory($stubsPath, 0755, true);
        }

        if (! is_dir($stubsPath.DIRECTORY_SEPARATOR.'views')) {
            (new Filesystem())->makeDirectory($stubsPath.DIRECTORY_SEPARATOR.'views', 0755, true);
        }

        $files = collect($this->stubs)
            ->mapWithKeys(function ($stub) use ($stubsPath) {
                return [__DIR__ . '/stubs/' . $stub => $stubsPath . '/' . $stub];
            })->toArray();

        foreach ($files as $from => $to) {
            if (! file_exists($to) || $this->option('force')) {
                file_put_contents($to, file_get_contents($from));
            }
        }

        $this->info('🎉 ACF Composer stubs successfully published.');
    }
}
