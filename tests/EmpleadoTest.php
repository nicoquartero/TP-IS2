<?php 
class EmpleadoTest extends \PHPUnit\Framework\TestCase 
{
	public function crearE_Eventual($nombre, $apellido, $dni, $salario, $montos)
	{
		$e = new \App\EmpleadoEventual($nombre,$apellido,$dni,$salario,$montos);
		return $e;
	}

	public function crearE_Permanente($nombre, $apellido, $dni, $salario, $fechaIngreso = null)
	{
		$e = new \App\EmpleadoPermanente($nombre,$apellido,$dni,$salario,$fechaIngreso);
		return $e;
	}

	public function testNombreApellidoDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("Nicolas Quartero",$e->getNombreApellido());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("Mauro Prieto",$p->getNombreApellido());
	}

	public function testNoSePuedeConstruirConDNIconteniendoLetrasEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("Nicolas","Quartero",'361a12b2',60000,$montos= array (100,200,300,400));	
	}

	public function testNoSePuedeConstruirConDNIconteniendoLetrasEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$p = $this->crearE_Permanente("Mauro","Prieto",'361a12b2',70000);
	}

	public function testNoSePuedeCrearConNombreVacioEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("","Quartero",36000111,60000,$montos= array (100,200,300,400));
	}

	public function testNoSePuedeCrearConNombreVacioEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$p = $this->crearE_Permanente("","Prieto",36207505,70000);
	}

	public function testNoSePuedeCrearConApellidoVacioEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("Nicolas","",36000111,60000,$montos= array (100,200,300,400));
	}

	public function testNoSePuedeCrearConApellidoVacioEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$p = $this->crearE_Permanente("Mauro","",36207505,70000);
	}

	public function testDNIDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals(36000111,$e->getDNI());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals(36207505,$p->getDNI());
	}

	public function testNoSePuedeConstruirConDNIvacioEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("Nicolas","Quartero","",60000,$montos= array (100,200,300,400));
	}

	public function testNoSePuedeConstruirConDNIvacioEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Permanente("Mauro","Prieto","",70000);
	}

	public function testSalarioDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals(60000,$e->getSalario());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals(70000,$p->getSalario());
	}

	public function testNoSePuedeConstruirConSalarioVacioEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,"",$montos= array (100,200,300,400));		
	}

	public function testNoSePuedeConstruirConSalarioVacioEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,"");		
	}

	public function testGetYSetSectorDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400)); //'e' de Eventual
		$e -> setSector('e');
		$this->assertEquals('e',$e->getSector());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000); //'p' de Permanente
		$p -> setSector('p');
		$this->assertEquals('p',$p->getSector());
	}


	public function test__toString()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("Nicolas Quartero 36000111 60000",$e->__toString());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("Mauro Prieto 36207505 70000",$p->__toString());
	}

	public function testSiNoSeEspecificaElSector()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("No especificado",$e->getSector());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("No especificado",$p->getSector());
	}
}

?>