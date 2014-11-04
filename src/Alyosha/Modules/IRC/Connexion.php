<?php

namespace Alyosha\Modules\IRC;

use Alyosha\Config;

class Connexion
{
	private $socket;
	private $server;
	private $port;
	private static $connexion;

	private function __construct($server, $port = 6667)
	{
        $this->server = $server;
        $this->port = $port;
		$this->socket = null;
	}

	public function __destruct()
	{
		if ($this->socket !== null) {
			fclose($this->socket);
		}
	}

	public function fire()
	{
		$this->socket = fsockopen($this->server, $this->port);
	}

	public function receive()
    {
        if ($this->socket == null) {
            throw new \Exception("La socket n'est pas ouverte.'");
        }
        $input = fgets($this->socket);
        echo $input;
        return $input;
    }
    
    public function send(array $messages)
    {
        if ($this->socket == null) {
            throw new \Exception("La socket n'est pas ouverte.'");
        }
        foreach ($messages as $message) {
            echo implode(' ', $message)."\n";
            fputs($this->socket, $message[0]." ".$message[1]."\r\n");
        }
    }

    public static function getInstance()
    {
    	if (self::$connexion === null) {
            self::$connexion = new Connexion(Config::$cfg['server'], Config::$cfg['port']);
    	}
        return self::$connexion;
    }
}
