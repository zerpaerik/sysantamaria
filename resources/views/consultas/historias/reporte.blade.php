<!DOCTYPE html>
<html lang="en">
<head>
	<title>Historia Clìnica</title>

</head>
<body>

	 <img src="/var/www/html/sysantamaria/public/img/logo2.png"  style="width: 20%;"/>
	<br><br>
	<CENTER><p><strong>HISTORIA CLINICA</strong></p></CENTER>
<br>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>RESUMEN DATOS GENERALES DE INGRESO</strong></legend>
            <p style="margin-bottom: 8px;">Nombre:{{$historias->nombres}},{{$historias->apellidos}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Historia Clìnica:{{$historias->historia}}</p>
            <p style="margin-bottom: 8px;">Fecha de Ingreso:{{date('d-m-Y', strtotime($historias->created_at))}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Hora de Ingreso:{{date('H:i:s', strtotime($historias->created_at))}}</p>
            <p style="margin-bottom: 8px;">Counter:{{Auth::user()->name}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Evaluador:{{$historias->personal}}</p>

        </fieldset> 
     </div>




     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>I. DATOS DE FILIACIÓN</strong></legend>
            <p style="margin-bottom: 8px;">Nombre y Apellidos:{{$historias->nombres}},{{$historias->apellidos}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Edad:{{$edad}}</p>
            <p style="margin-bottom: 8px;">Sexo:{{$historias->sexo}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Identifación:{{$historias->dni}}</p>
            <p style="margin-bottom: 8px;">Teléfono:{{$historias->telefono}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Referencia:{{$historias->direccion}}</p>
             <p style="margin-bottom: 8px;">Direcciòn:{{$historias->direccion}}<</p>
             <p style="margin-bottom: 8px;">Ocupación:{{$historias->ocupacion}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Grado Instrucción:{{$historias->gradoinstruccion}}</p>
            <p style="margin-bottom: 8px;">Fecha Nacimiento:{{$historias->fechanac}}</p>

        </fieldset> 
     </div>

      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>II. ANAMNESIS</strong></legend>
             <p>1. Motivo de Consulta:{{$historias->motivo}}</p>
             <p>2. Causa Relacionada:{{$historias->causa}}</p>
             <p>3. Tiempo Lesión:{{$historias->tiempo}}</p>
             <p>4. Evolución de Enfermedad:{{$historias->enf}}</p>

        </fieldset> 
     </div>

      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>III. ANTECEDENTES</strong></legend>
             <p>a) Personales</p>
             <p>1. Enfermedades:{{$historias->enf}}</p>
             <p>2. Quirurgicos:{{$historias->fra}}</p>
             <p>3. Alérgicos:{{$historias->aler}}</p>
             <p>4. Medicación Habitual:{{$historias->ope}}</p>
             <br>
             <p>b) Familiares</p>


        </fieldset> 
     </div>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>EXAMEN FÍSICO</strong></legend>
            <p>1) Funciones Vitales</p>
            <p style="margin-bottom: 8px;">P/A:{{$historias->pa}}mmHg</p>
            <p style="margin-left:380px;margin-top: -30px;">F/C:{{$historias->fc}}X'</p>
            <p style="margin-bottom: 8px;">F/R:{{$historias->fr}}X'</p>
            <p style="margin-left:380px;margin-top: -30px;">Peso:{{$historias->peso}}Kg</p>
            <p style="margin-bottom: 8px;">Talla: {{$historias->talla}}Mtrs</p>
            <p style="margin-left:380px;margin-top: -30px;">Temperatura:{{$historias->peso}}T</p>
            
            <p>2) Examen General: {{$historias->exa}}</p>
          
            <p style="margin-bottom: 8px;">3) Diágnóstico Presuntivo: {{$historias->pres}}</p>
            <p style="margin-left:380px;margin-top: -30px;"> CIEX: {{$historias->ciex}}</p>
           
            <p>4) Examenes y Pruebas Auxiliares: {{$historias->aux}}</p>
           
            <p style="margin-bottom: 8px;">5) Diágnóstico Definitivo: {{$historias->def}}</p>
            <p style="margin-left:380px;margin-top: -30px;"> CIEX: {{$historias->ciex2}}</p>
        
             <p>6) Diágnóstico Topográfico: {{$historias->top}}</p>
          <p>7) Plan de Tratamiento: {{$historias->plan}}</p>
            <p>8) Número de Sesiones: {{$historias->ses}}</p>


 
        </fieldset> 
     </div>

   


    

 
</body>
</html>