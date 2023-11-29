<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application,
    Bitrix\Main\Loader;
use Bitrix\Main\EventManager,
    Bitrix\Main\ModuleManager;


Loc::loadMessages(__FILE__);


class test_app extends CModule {

    /**
     * @var string
     */
    const MODULE_ID = 'test.app';
    public $MODULE_ID = 'test.app';
    /**
     * @var
     */
    public $MODULE_VERSION;
    /**
     * @var
     */
    public $MODULE_VERSION_DATE;
    /**
     * @var string
     */
    public $MODULE_NAME;
    /**
     * @var string
     */
    public $MODULE_DESCRIPTION;

    /**
     * Инициализация модуля для страницы "Управление модулями"
     */
    function __construct() {
        $arModuleVersion = array();
        include(__DIR__ . "/version.php");

        $this->MODULE_NAME = Loc::getMessage( self::MODULE_ID.'_MODULE_NAME' );
        $this->MODULE_DESCRIPTION = Loc::getMessage( self::MODULE_ID.'_MODULE_DESCRIPTION' );
        $this->PARTNER_NAME	= Loc::getMessage( self::MODULE_ID.'_PARTNER_NAME' );
        $this->PARTNER_URI	= Loc::getMessage( self::MODULE_ID.'_PARTNER_URI' );
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }


    /**
     * Устанавливаем модуль
     */
    function DoInstall()
    {
        global $APPLICATION;
        RegisterModule(self::MODULE_ID);
        $this->InstallEvents();
    }

    function DoUninstall()
    {
        global $APPLICATION;
        $this->UnInstallEvents();
        UnRegisterModule(self::MODULE_ID);
    }

    /**
     * @return bool|void
     * @throws \Bitrix\Main\LoaderException
     */
    public function installEvents() {

        EventManager::getInstance()->registerEventHandler(
            'rest',
            'OnRestServiceBuildDescription',
            self::MODULE_ID,
            'Test\App\UserSection\Rest\UserRest',
            'OnRestServiceBuildDescription'
        );

        return true;
    }

    /**
     * @return bool|void
     * @throws \Bitrix\Main\LoaderException
     */
    public function unInstallEvents() {

        EventManager::getInstance()->unRegisterEventHandler(
            'rest',
            'OnRestServiceBuildDescription',
            self::MODULE_ID,
            'Test\App\UserSection\Rest\UserRest',
            'OnRestServiceBuildDescription'
        );

        return true;
    }
}
