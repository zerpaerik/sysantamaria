<!DOCTYPE html>
<html lang="en">
<head>
	<title>Historia Clìnica</title>

</head>
<body>

	<br><br>
	<CENTER><p><strong>HISTORIA CLINICA</strong></p></CENTER>
<br>
     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>RESUMEN DATOS GENERALES DE INGRESO</strong></legend>
            <p style="margin-bottom: 8px;">Nombre:</p>
            <p style="margin-left:380px;margin-top: -30px;">Historia Clìnica:</p>
            <p style="margin-bottom: 8px;">Fecha de Ingreso:</p>
            <p style="margin-left:380px;margin-top: -30px;">Hora de Ingreso:</p>
            <p style="margin-bottom: 8px;">Counter:</p>
            <p style="margin-left:380px;margin-top: -30px;">Evaluador:</p>

        </fieldset> 
     </div>

     @foreach($historias as $h)

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>I. DATOS DE FILIACIÓN</strong></legend>
            <p style="margin-bottom: 8px;">Nombre y Apellidos:{{$h->nombres}},{{$h->apellidos}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Edad:</p>
            <p style="margin-bottom: 8px;">Sexo:</p>
            <p style="margin-left:380px;margin-top: -30px;">Identifación:{{$h->dni}}</p>
            <p style="margin-bottom: 8px;">Teléfono:</p>
            <p style="margin-left:380px;margin-top: -30px;">Dirección:{{$h->direccion}}</p>
             <p style="margin-bottom: 8px;">Referencia:</p>
            <p style="margin-left:380px;margin-top: -30px;">Fecha Nacimiento:{{$h->fechanac}}</p>
             <p style="margin-bottom: 8px;">Ocupación:{{$h->ocupacion}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Grado Instrucción:{{$h->gradoinstruccion}}</p>

        </fieldset> 
     </div>

      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>II. ANAMNESIS</strong></legend>
             <p>1. Motivo de Consulta:{{$h->motivo}}</p>
             <p>2. Causa Relacionada:{{$h->causa}}</p>
             <p>3. Tiempo Lesión:{{$h->tiempo}}</p>
             <p>4. Evolución de Enfermedad:{{$h->enf}}</p>

        </fieldset> 
     </div>

      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>III. ANTECEDENTES</strong></legend>
             <p>a) Personales</p>
             <p>1. Enfermedades:{{$h->enf}}</p>
             <p>2. Quirurgicos:{{$h->fra}}</p>
             <p>3. Alérgicos:{{$h->aler}}</p>
             <p>4. Medicación Habitual:{{$h->ope}}</p>
             <br>
             <p>b) Familiares</p>


        </fieldset> 
     </div>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>EXAMEN FÍSICO</strong></legend>
            <p>1) Funciones Vitales</p>
            <p style="margin-bottom: 8px;">Presión Arterial:{{$h->pa}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Frecuencia Cardíaca:{{$h->fc}}</p>
            <p style="margin-bottom: 8px;">Frecuencia Respiratoria:{{$h->fr}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Peso:{{$h->peso}}</p>
            <p style="margin-bottom: 8px;">Talla: {{$h->talla}}</p>
            
            <p>2) Examen General: {{$h->exa}}</p>
          
            <p style="margin-bottom: 8px;">3) Diágnóstico Presuntivo: {{$h->pres}}</p>
            <p style="margin-left:380px;margin-top: -30px;"> CIEX: {{$h->ciex}}</p>
           
            <p>4) Examenes y Pruebas Auxiliares: {{$h->aux}}</p>
           
            <p style="margin-bottom: 8px;">5) Diágnóstico Definitivo: {{$h->def}}</p>
            <p style="margin-left:380px;margin-top: -30px;"> CIEX: {{$h->ciex2}}</p>
        
             <p>6) Diágnóstico Topográfico: {{$h->top}}</p>
          <p>7) Plan de Tratamiento: {{$h->plan}}</p>
            <p>8) Número de Sesiones: {{$h->ses}}</p>


 
        </fieldset> 
     </div>

   

     @endforeach

    

 
</body>
</html>