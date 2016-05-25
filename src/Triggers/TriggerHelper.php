<?php

namespace KarGolSan\InstallWizard\Triggers;

use KarGolSan\InstallWizard\Contracts\WizardTrigger;

/**
 * Class TriggerHelper
 *
 * @package KarGolSan\InstallWizard\Triggers
 *
 * Some utility functions to work with triggers
 */
class TriggerHelper
{
    /**
     * @return bool Returns true if the wizard has to be Launched
     */
    public static function shouldWizardBeTriggered()
    {
        // Get triggers from configuration and redirect to wizard if any of them fires
        $triggerClasses = config('install_wizard.triggers');
        foreach ($triggerClasses as $tc){
            /** @var WizardTrigger $trigger */
            $trigger = new $tc();
            if ($trigger->shouldLaunchWizard()) return true;
        }

        return false;
    }

    public static function hasWizardCompleted()
    {
        $wizardFile = storage_path('.install_wizard');

        return file_exists($wizardFile);
    }
}