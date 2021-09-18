<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Traits\Selenium;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\UnexpectedAlertOpenException;
use Facebook\WebDriver\WebDriverKeys;

class EnvioMsgController extends Controller
{
    use Selenium;
    
    private string $url = 'https://web.whatsapp.com/send/?phone=';
    private string $message;
    
    private int $phoneNumber;
    
    public function index()
    {
        $this->newSession();
        
        $this->url .= $this->phoneNumber;
        
        try {
            
            $this->driver->get($this->url);
            
            $this->sendMessage();
        
        } catch (UnexpectedAlertOpenException $e) {
            // Dá enter caso o navegador pergunte sobre o refresh na página.
            $this->driver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
            
            $this->sendMessage();
        }
    }
    
    /**
     * Método responsável por enviar as mensagens.
     */
    private function sendMessage(): void
    {
        $driver = $this->driver;
        
        $this->driver->wait()->until(
            function () use ($driver) {
                
                $elements = $driver->findElements(WebDriverBy::className('_13NKt'));
                
                return count($elements) == 2;
            },
            'Error ao identificar o elemento de mensagem'
        );
        
        $messageBox = $driver->findElements(WebDriverBy::className('_13NKt'));

        $messageBox[1]->sendKeys($this->message);
        
        $this->driver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
    }
    
    /**
     * @todo Necessário que a mensagem venha do banco de dados.
     * @return string
     */
    public function getMessageDatabase()
    {
        return $this->message;
    }
    
    public function setMessageDatabase(string $message)
    {
        $this->message = $message;
    }
    
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}
