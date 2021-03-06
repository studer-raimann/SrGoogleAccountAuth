<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\DevTools\SrGoogleAccountAuth\DevToolsCtrl;
use srag\DIC\SrGoogleAccountAuth\DICTrait;
use srag\Plugins\SrGoogleAccountAuth\Config\ConfigCtrl;
use srag\Plugins\SrGoogleAccountAuth\Utils\SrGoogleAccountAuthTrait;

/**
 * Class ilSrGoogleAccountAuthConfigGUI
 *
 * @author            studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @ilCtrl_isCalledBy srag\DevTools\SrGoogleAccountAuth\DevToolsCtrl: ilSrGoogleAccountAuthConfigGUI
 */
class ilSrGoogleAccountAuthConfigGUI extends ilPluginConfigGUI
{

    use DICTrait;
    use SrGoogleAccountAuthTrait;

    const CMD_CONFIGURE = "configure";
    const PLUGIN_CLASS_NAME = ilSrGoogleAccountAuthPlugin::class;


    /**
     * ilSrGoogleAccountAuthConfigGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function performCommand(/*string*/ $cmd)/*:void*/
    {
        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            case strtolower(ConfigCtrl::class):
                self::dic()->ctrl()->forwardCommand(new ConfigCtrl());
                break;

            case strtolower(DevToolsCtrl::class):
                self::dic()->ctrl()->forwardCommand(new DevToolsCtrl($this, self::plugin()));
                break;

            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CONFIGURE:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    /**
     *
     */
    protected function configure()/*: void*/
    {
        self::dic()->ctrl()->redirectByClass(ConfigCtrl::class, ConfigCtrl::CMD_CONFIGURE);
    }


    /**
     *
     */
    protected function setTabs()/*: void*/
    {
        ConfigCtrl::addTabs();

        DevToolsCtrl::addTabs(self::plugin());

        self::dic()->locator()->addItem(ilSrGoogleAccountAuthPlugin::PLUGIN_NAME, self::dic()->ctrl()->getLinkTarget($this, self::CMD_CONFIGURE));
    }
}
