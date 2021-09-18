<?php
namespace App\Http\Traits;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Facades\Storage;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\Remote\RemoteWebElement;

trait Selenium
{
    private $driver;
    private $timeout = 180;
    private $interval = 500;
    
    public function newSession(bool $withoutInterface = false): void
    {
        $capabilities = DesiredCapabilities::chrome();
        
        $options = new ChromeOptions();
        
        $options->setExperimentalOption('debuggerAddress', 'localhost:9222');
        $options->addArguments(["--disable-notifications"]);
        
//         $options->addArguments(['--no-sandbox']);
        
        if($withoutInterface === true) {
            $options->addArguments(['--headless']);
        }

        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
        
        $capabilities->setCapability( 'loggingPrefs', ['browser' => 'ALL']);
        
        $this->driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities, 180000, 180000);
    }
       
    private function waitPageLoad()
    {
        $statusDesejado = 'complete';
        do {
            $statusAtual = $this->driver->executeScript("return document.readyState;");
        } while ($statusDesejado != $statusAtual);
    }
    
    public function getDriver()
    {
        return $this->driver;
    }
}