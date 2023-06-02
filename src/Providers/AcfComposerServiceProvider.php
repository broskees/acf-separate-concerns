<?php

namespace Broskees\AcfSeparateConcerns\Providers;

use Log1x\AcfComposer\Providers\AcfComposerServiceProvider as AcfComposerServiceProviderBase;
use Broskees\AcfSeparateConcerns\Console\{BlockMakeCommand, OptionsMakeCommand, PartialMakeCommand, WidgetMakeCommand, FieldMakeCommand, StubPublishCommand};
use Broskees\AcfSeparateConcerns\AcfComposer;

class AcfComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->forgetInstance('AcfComposer');
        $this->app->singleton('AcfComposer', function () {
            return new AcfComposer($this->app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->commands([
            BlockMakeCommand::class,
            FieldMakeCommand::class,
            OptionsMakeCommand::class,
            PartialMakeCommand::class,
            WidgetMakeCommand::class,
            StubPublishCommand::class,
        ]);
    }
}
