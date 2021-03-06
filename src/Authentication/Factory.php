<?php

namespace srag\Plugins\SrGoogleAccountAuth\Authentication;

use ilAuthCredentials;
use ilSrGoogleAccountAuthPlugin;
use ilSrGoogleAccountAuthUIHookGUI;
use srag\DIC\SrGoogleAccountAuth\DICTrait;
use srag\Plugins\SrGoogleAccountAuth\Authentication\Form\FormBuilder;
use srag\Plugins\SrGoogleAccountAuth\Utils\SrGoogleAccountAuthTrait;

/**
 * Class Factory
 *
 * @package srag\Plugins\SrGoogleAccountAuth\Authentication
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory
{

    use DICTrait;
    use SrGoogleAccountAuthTrait;

    const PLUGIN_CLASS_NAME = ilSrGoogleAccountAuthPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Factory constructor
     */
    private function __construct()
    {

    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @param ilSrGoogleAccountAuthUIHookGUI $parent
     *
     * @return FormBuilder
     */
    public function newFormBuilderInstance(ilSrGoogleAccountAuthUIHookGUI $parent) : FormBuilder
    {
        $form = new FormBuilder($parent);

        return $form;
    }


    /**
     * @param ilAuthCredentials $credentials
     *
     * @return AuthenticationProvider
     */
    public function newProviderInstance(ilAuthCredentials $credentials) : AuthenticationProvider
    {
        $provider = new AuthenticationProvider($credentials);

        return $provider;
    }
}
