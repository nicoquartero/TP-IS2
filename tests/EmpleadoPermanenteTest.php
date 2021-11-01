<?php 
require_once 'EmpleadoTest.php';
class EmpleadoPermanenteTest extends EmpleadoTest
{
	//Testeando que GetFechaIngreso retorna la fecha de ingreso
	public function testGetFechaDeIngreso()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearE_Permanente("Mauro","Prieto",36207505,60000, $fechaIngreso);
		$this->assertEquals($fechaIngreso,$ep->getFechaIngreso());
	}


	//Probando que si no se setea la fecha de ingreso, se autoasigna la fecha actual y el calculo de antiguedad resulta cero
	public function testSinFechaDeIngresoYSinAntiguedad()
	{
		$fechaIngreso = new DateTime();
		$ep = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals($fechaIngreso->format('Y-m-d'),$ep->getFechaIngreso()->format('Y-m-d'));
		$this->assertEquals(0,$ep->calcularAntiguedad());
	}


	//testeando que si se ingresa una fecha futura como FechaIngreso, lance una excepcion
	public function testFechaDeIngresoFutura()
	{
		$fechaIngreso = new DateTime();
		$fechaIngreso->add(new DateInterval('P1Y')); //sumando 1 año a la fecha actual
		$this->expectException(\Exception::class);
		$ep = $this->crearE_Permanente("Mauro","Prieto",36207505,70000, $fechaIngreso);
	}


	//testeando el calculo de la antiguedad en años
	public function testCalcularAntiguedad()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearE_Permanente("Mauro","Prieto",36207505,70000, $fechaIngreso);
		$this->assertEquals(8, $ep->calcularAntiguedad());
	}


	//testeando el calculo de la comusion segun los años de antiguedad
	public function testcalcularComision()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearE_Permanente("Mauro","Prieto",36207505,70000,$fechaIngreso);
		$this->assertEquals("8%",$ep->calcularComision());
	}


	//Prueba del calculo del ingreso total
	public function testcalcularIngresoTotal()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearE_Permanente("Nicolas","Prieto",36207505,70000,$fechaIngreso);
		$this->assertEquals(70000 + (70000 * (8 / 100)),$ep->calcularIngresoTotal());
	}


	//Generando error en el test para probar la interaccion continua con git
	public function testcalcularIngresoTotal()
	{
		$fechaIngreso = new DateTime('2013-03-01 00:00:00');
		$ep = $this->crearE_Permanente("Nicolas","Prieto",36207505,70000,$fechaIngreso);
		$this->assertEquals(70000 + (70000 * (8 / 10)),$ep->calcularIngresoTotal());
	}

}

?>