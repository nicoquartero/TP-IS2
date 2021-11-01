<?php 
class EmpleadoTest extends \PHPUnit\Framework\TestCase 
{

	// Creacion de ambos objetos, empleado eventual y empleado permanente
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


	//Prueba de getNombreApellido para ambas clases, eventual y permanente
	public function testNombreApellidoDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("Nicolas Quartero",$e->getNombreApellido());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("Mauro Prieto",$p->getNombreApellido());
	}


	//test para corroborar la excepcion que debe ejecutar si se ingresa un DNI con letras para ambas clases
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


	//chequeando que no se pueda crear un empleado con el NOMBRE vacio, ni eventual, ni permanente
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


	//chequeando que no se pueda crear un empleado con el APELLIDO vacio, ni eventual, ni permanente
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


	//test para probar el getDNI para ambos tipos de empleados
	public function testDNIDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals(36000111,$e->getDNI());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals(36207505,$p->getDNI());
	}


	//Probando la ejecucion de una excepcion al intentar crear un empleado con DNI vacio, para ambos tipos:
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


	//test para el getSalario en ambos tipos de empleados
	public function testSalarioDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals(60000,$e->getSalario());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals(70000,$p->getSalario());
	}


	//Test para constatar que no se pueda construir un empleado con salario en blanco
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


	//Test para constatar que no se pueda construir un empleado con salario igual a Cero
	public function testNoSePuedeConstruirConSalarioCeroEmpleadoEventual()
	{
		$this->expectException(\Exception::class);
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,0,$montos= array (100,200,300,400));		
	}

	public function testNoSePuedeConstruirConSalarioCeroEmpleadoPermanente()
	{
		$this->expectException(\Exception::class);
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,0);		
	}


	//test para probar el get y set del sector, para cada empleado
	public function testGetYSetSectorDelEmpleado()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400)); //'e' de Eventual
		$e -> setSector('e');
		$this->assertEquals('e',$e->getSector());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000); //'p' de Permanente
		$p -> setSector('p');
		$this->assertEquals('p',$p->getSector());
	}


	//Probando que la devolucion de __toString sea correcta para ambos tipos objetos
	public function test__toString()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("Nicolas Quartero 36000111 60000",$e->__toString());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("Mauro Prieto 36207505 70000",$p->__toString());
	}


	//Chequeando que si no se especifica el sector, el getSector retorna "No especificado"
	public function testSiNoSeEspecificaElSector()
	{
		$e = $this->crearE_Eventual("Nicolas","Quartero",36000111,60000,$montos= array (100,200,300,400));
		$this->assertEquals("No especificado",$e->getSector());
		$p = $this->crearE_Permanente("Mauro","Prieto",36207505,70000);
		$this->assertEquals("No especificado",$p->getSector());
	}
}

?>