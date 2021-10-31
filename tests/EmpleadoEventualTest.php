<?php
require_once 'EmpleadoTest.php';
class EmpleadoEventualTest extends EmpleadoTest
{
	private $ventas = array(100,200,300,400,500);
	private $nombre = "Nicolas";
	private $apellido = "Nicolas";
	private $DNI = 36111222;
	private $salario = 60000;

	//Testeando que el metodo calcularComision funcione como se espera
	public function testCalcularComision()
	{
		$empE = $this->crearE_Eventual($this->nombre,$this->apellido,$this->DNI,$this->salario,$this->ventas);
		$com = (1500 / count($this->ventas)) * 0.05;
		$this->assertEquals($com, $empE -> calcularComision());
	}

	//Testeando que el metodo calcularIngresoTotal funcione como se espera
	public function testCalcularIngresoTotal()
	{
		$empE = $this->crearE_Eventual($this->nombre,$this->apellido,$this->DNI,$this->salario,$this->ventas);
		$this->assertEquals(60000 + $empE -> calcularComision(), $empE -> calcularIngresoTotal());	
	}

}
?>