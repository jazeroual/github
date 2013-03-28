<?
class manager{

	function connect ($varLogin,$varPassword){
		echo utf8_decode("Bonjour tu es connecté sous " . $varLogin);
	}


	public function disconnect ($varLogin,$varPassword){
		echo "déconnection de : " . $varLogin;
		$this->hello($varLogin,$varPassword);
	}

	function hello ($varLogin,$varPassword){
		echo "Hello";
	}

	
}

?>