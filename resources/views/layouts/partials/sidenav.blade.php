@if(\Auth::user()->role_id == 4)

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Admisión</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Pacientes/Clientes</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('pacientes.create')}}"><i class="fa fa-list-alt"></i> Registro de pacientes</a>
          </li>


          <li>
            <a href="{{route('service.inicio')}}"><i class="fa fa-list-alt"></i> Programación de citas</a>
          </li>


        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Movimientos de Caja</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('generics.router')}}"><i class="fa fa-plus-square-o"></i> Registro Ingresos/Gastos</a>
          </li>

           <li>
          <a href="{{route('movimientos.index')}}"><i class="fa fa-random"></i> Registros del Dia</a>
          </li>


          <li>
            <a href="{{route('cierre.index')}}"><i class="fa fa-plus-square-o"></i> Cierre de caja</a>
          </li>

          <li>
          <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Gastos del día</a>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Consolidado Ingresos/Gastos</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('solicitar.consolidado')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Detallado</a>
              </li>
              <li>
                <a href="{{route('solicitar.diario')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Consolidado</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Cobros</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-plus-square-o"></i> Cuentas por Cobrar</a>
              </li>
              <li>
                <a href="{{route('historialcobros.index')}}"><i class="fa fa-plus-square-o"></i> Historial de Cobros</a>
              </li>
            </ul>
          </li>
        </ul>      
    </li>
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Asistencial</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('historias.index')}}"><i class="fa fa-circle-o"></i> Historia Clínica</a>
    </li> 
     <li>
      <a href="{{route('fichast.index')}}"><i class="fa fa-circle-o"></i> Fichas Terapeuticas</a>
    </li>
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
       <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Registrar Evaluación</a>
      </li>
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programación</a>
      </li> 
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> Almacen Central</a>
    </li>
    <li>
      <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Pedido Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Transferir Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index3')}}"><i class="fa fa-plus-square-o"></i> Transferencia de Productos</a>
          </li>
        </ul>      
    </li>
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Comisiones</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="{{route('comporpagar.index')}}" class="dropdown-toggle"><i class="fa fa-tasks"></i> Liquidación de Médicos</a>
       
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Liquidación Personal</a>
          <ul class="dropdown-menu">

          <li>
            <a href="{{route('comporpagartec.index')}}"><i class="fa fa-plus-square-o"></i> Tecnólogo</a>
          </li>


          <li>
            <a href="{{route('compunziones.index')}}"><i class="fa fa-plus-square-o"></i> Técnico Administrativo</a>
          </li>

          </ul>      
      </li>
    </ul>
  </li>      
</li>
 <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Evaluaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
    </ul>
  </li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Gestión</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('movimientos.index')}}"><i class="fa fa-circle-o"></i> Ingresos y Gastos</a>
    </li> 
    <li>
      <a href="{{route('pacientes.indexr')}}"><i class="fa fa-users"></i> Pacientes/clientes</a>
    </li>
   
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Derivaciones</a>
    </li>
    <li>
      <a href="{{route('produccion.index')}}"><i class="fa fa-circle-o"></i> Producción</a>
    </li>
    <li>
      <a href="{{route('compagadas.index')}}"><i class="fa fa-renren"></i> Pagos por Comisiones</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Tarifarios/Convenios</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Reportes</a>
        <ul class="dropdown-menu">
          <li>

            <a href="{{route('generalatenciones.indexa')}}"><i class="fa fa-file-o"></i> General Atenciones</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Cómo llego el Paciente?</a>
      </li>
     <li>
        <a href="{{route('historial.index')}}"><i class="fa fa-file-o"></i> Historial</a>
      </li>


        </ul>      
    </li> 
    <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Archivos</a>
            <ul class="dropdown-menu"> 
              <li>
      <a href="{{route('empresas.index')}}"><i class="fa fa-circle-o"></i> Empresas</a>
    </li> 
    <li>
      <a href="{{route('personal.index')}}"><i class="fa fa-users"></i> Personal</a>
    </li>
    <li>
      <a href="{{route('centros.index')}}"><i class="fa fa-hospital-o"></i> Centros medicos</a>
    </li>
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Prof. de apoyo</a>
    </li>
    <li>
      <a href="{{route('laboratorios.index')}}"><i class="fa fa-circle-o"></i> Laboratorios</a>
    </li>
    <li>
      <a href="{{route('analisis.index')}}"><i class="fa fa-renren"></i> Analisis de laboratorios</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Servicios</a>
    </li>
    <li>
      <a href="{{route('paquetes.index')}}"><i class="fa fa-dropbox"></i> Paquetes de servicios</a>
    </li>
    <li>
      <a href="{{route('pacientes.index')}}"><i class="fa fa-wheelchair"></i> Pacientes</a>
    </li>  
            </ul>
          </li>   
  </ul>
</li>



  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Registrar Sesión</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Sesiones</a>
      </li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
        <li>
        <a href="{{route('cierre.index')}}"><i class="fa fa-file-o"></i> Cierre de Caja</a>
      </li> 
       <li>
        <a href="{{route('pacientes.indexr')}}"><i class="fa fa-file-o"></i> Clientes por Mes</a>
      </li> 
      <li>
        <a href="reporte-solicitar_diario"><i class="fa fa-file-o"></i> Atención Diaria Consolidado</a>
      </li>
       <li>
        <a href="reporte-solicitar_consolidado"><i class="fa fa-file-o"></i> Atención Diaria Detallado</a>
      </li>
      <li>
        <a href="{{route('generalatenciones.indexa')}}"><i class="fa fa-file-o"></i> General Atenciones</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Cómo llego el Paciente?</a>
      </li>
     <li>
        <a href="{{route('historial.index')}}"><i class="fa fa-file-o"></i> Historial</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li>
      @if(\Auth::user()->role_id == 4)
      <li>
        <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li>
        <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
      </li>     
      <li>
        <a href="{{route('proveedores.index')}}"><i class="fa fa-hospital-o"></i> Proveedores</a>
      </li>       
      @endif
    </ul>
  </li>

  @endif

@if(\Auth::user()->role_id == 5)

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Admisión</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Pacientes/Clientes</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('pacientes.create')}}"><i class="fa fa-list-alt"></i> Registro de pacientes</a>
          </li>


          <li>
            <a href="{{route('consultas.inicio')}}"><i class="fa fa-list-alt"></i> Programación de citas</a>
          </li>


          <li>
            <a href="{{route('proximacita.index')}}"><i class="fa fa-list-alt"></i> Control de citas/Evaluaciones</a>
          </li>


        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Movimientos de Caja</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('generics.router')}}"><i class="fa fa-plus-square-o"></i> Registro Ingresos/Gastos</a>
          </li>

           <li>
          <a href="{{route('movimientos.index')}}"><i class="fa fa-random"></i> Registros del Dia</a>
          </li>


          <li>
            <a href="{{route('cierre.index')}}"><i class="fa fa-plus-square-o"></i> Detalle Ingresos/Gastos</a>
          </li>

          <li>
          <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de Gastos</a>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Consolidado Ingresos/Gastos</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('solicitar.consolidado')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Detallado</a>
              </li>
              <li>
                <a href="{{route('solicitar.diario')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Consolidado</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Cobros</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-plus-square-o"></i> Cuentas por Cobrar</a>
              </li>
              <li>
                <a href="{{route('historialcobros.index')}}"><i class="fa fa-plus-square-o"></i> Historial de Cobros</a>
              </li>
            </ul>
          </li>
        </ul>      
    </li>
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Asistencial</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('historias.index')}}"><i class="fa fa-circle-o"></i> Historia Clínica</a>
    </li> 
     <li>
      <a href="{{route('fichast.index')}}"><i class="fa fa-circle-o"></i> Fichas Terapeuticas</a>
    </li>
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
       <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Registrar Evaluación</a>
      </li>
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programación</a>
      </li> 
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> Almacen Central</a>
    </li>
    <li>
      <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Pedido Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Transferir Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index3')}}"><i class="fa fa-plus-square-o"></i> Transferencia de Productos</a>
          </li>
        </ul>      
    </li>
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Comisiones</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="{{route('comporpagar.index')}}" class="dropdown-toggle"><i class="fa fa-tasks"></i> Liquidación de Médicos</a>
       
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Liquidación Personal</a>
          <ul class="dropdown-menu">

          <li>
            <a href="{{route('comporpagartec.index')}}"><i class="fa fa-plus-square-o"></i> Tecnólogo</a>
          </li>


          <li>
            <a href="{{route('compunziones.index')}}"><i class="fa fa-plus-square-o"></i> Técnico Administrativo</a>
          </li>

          </ul>      
      </li>
    </ul>
  </li>      
</li>
 <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Evaluaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
    </ul>
  </li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Gestión</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('movimientos.index')}}"><i class="fa fa-circle-o"></i> Ingresos y Gastos</a>
    </li> 
    <li>
      <a href="{{route('pacientes.indexr')}}"><i class="fa fa-users"></i> Pacientes/clientes</a>
    </li>
   
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Derivaciones</a>
    </li>
    <li>
      <a href="{{route('produccion.index')}}"><i class="fa fa-circle-o"></i> Producción</a>
    </li>
    <li>
      <a href="{{route('compagadas.index')}}"><i class="fa fa-renren"></i> Pagos por Comisiones</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Tarifarios/Convenios</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Reportes</a>
        <ul class="dropdown-menu">
          <li>

            <a href="{{route('generalatenciones.indexa')}}"><i class="fa fa-file-o"></i> General Atenciones</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Cómo llego el Paciente?</a>
      </li>
     <li>
        <a href="{{route('historial.index')}}"><i class="fa fa-file-o"></i> Historial</a>
      </li>


        </ul>      
    </li>


  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Registrar Sesión</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Sesiones</a>
      </li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
        <li>
        <a href="{{route('cierre.index')}}"><i class="fa fa-file-o"></i> Cierre de Caja</a>
      </li> 
       <li>
        <a href="{{route('pacientes.indexr')}}"><i class="fa fa-file-o"></i> Clientes por Mes</a>
      </li> 
      <li>
        <a href="reporte-solicitar_diario"><i class="fa fa-file-o"></i> Atención Diaria Consolidado</a>
      </li>
       <li>
        <a href="reporte-solicitar_consolidado"><i class="fa fa-file-o"></i> Atención Diaria Detallado</a>
      </li>
      <li>
        <a href="{{route('generalatenciones.indexa')}}"><i class="fa fa-file-o"></i> General Atenciones</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Cómo llego el Paciente?</a>
      </li>
     <li>
        <a href="{{route('historial.index')}}"><i class="fa fa-file-o"></i> Historial</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li>
      @if(\Auth::user()->role_id == 4)
      <li>
        <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li>
        <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
      </li>     
      <li>
        <a href="{{route('proveedores.index')}}"><i class="fa fa-hospital-o"></i> Proveedores</a>
      </li>       
      @endif
    </ul>
  </li>


@endif

@if(\Auth::user()->role_id == 6)

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Admisión</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Pacientes/Clientes</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('pacientes.create')}}"><i class="fa fa-list-alt"></i> Registro de pacientes</a>
          </li>


          <li>
            <a href="{{route('consultas.inicio')}}"><i class="fa fa-list-alt"></i> Programación de citas</a>
          </li>


          <li>
            <a href="{{route('proximacita.index')}}"><i class="fa fa-list-alt"></i> Control de citas/Evaluaciones</a>
          </li>


        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Movimientos de Caja</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('generics.router')}}"><i class="fa fa-plus-square-o"></i> Registro Ingresos/Gastos</a>
          </li>

           <li>
          <a href="{{route('movimientos.index')}}"><i class="fa fa-random"></i> Registros del Dia</a>
          </li>


          <li>
            <a href="{{route('cierre.index')}}"><i class="fa fa-plus-square-o"></i> Detalle Ingresos/Gastos</a>
          </li>

          <li>
          <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de Gastos</a>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Consolidado Ingresos/Gastos</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('solicitar.consolidado')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Detallado</a>
              </li>
              <li>
                <a href="{{route('solicitar.diario')}}"><i class="fa fa-plus-square-o"></i> Atención Diaria Consolidado</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Cobros</a>
            <ul class="dropdown-menu"> 
              <li>
                <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-plus-square-o"></i> Cuentas por Cobrar</a>
              </li>
              <li>
                <a href="{{route('historialcobros.index')}}"><i class="fa fa-plus-square-o"></i> Historial de Cobros</a>
              </li>
            </ul>
          </li>
        </ul>      
    </li>
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Asistencial</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('historias.index')}}"><i class="fa fa-circle-o"></i> Historia Clínica</a>
    </li> 
     <li>
      <a href="{{route('fichast.index')}}"><i class="fa fa-circle-o"></i> Fichas Terapeuticas</a>
    </li>
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
       <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Registrar Evaluación</a>
      </li>
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programación</a>
      </li> 
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> Almacen Central</a>
    </li>
    <li>
      <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Pedido Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Transferir Productos</a>
          </li>
          <li>
            <a href="{{route('requerimientos.index3')}}"><i class="fa fa-plus-square-o"></i> Transferencia de Productos</a>
          </li>
        </ul>      
    </li>
  </ul>
</li>



   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li>   
         
    </ul>
  </li>


@endif

@if(\Auth::user()->role_id == 7)

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Asistencial</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('historias.index')}}"><i class="fa fa-circle-o"></i> Historia Clínica</a>
    </li> 
     <li>
      <a href="{{route('fichast.index')}}"><i class="fa fa-circle-o"></i> Fichas Terapeuticas</a>
    </li>
      <li>
        <a href="{{route('prenatal.create')}}"><i class="fa fa-list-alt"></i> Registrar Tratamiento</a>
      </li>
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-search"></i> Buscar Tratamiento</a>
      </li>
       <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Registrar Evaluación</a>
      </li>
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programación</a>
      </li> 
  </ul>
</li>
    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Registrar Sesión</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Sesiones</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Admisión</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Pacientes/Clientes</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('pacientes.create')}}"><i class="fa fa-list-alt"></i> Registro de pacientes</a>
          </li>


          <li>
            <a href="{{route('consultas.inicio')}}"><i class="fa fa-list-alt"></i> Programación de citas</a>
          </li>


          <li>
            <a href="{{route('proximacita.index')}}"><i class="fa fa-list-alt"></i> Control de citas/Evaluaciones</a>
          </li>


        </ul>      
    </li>
  
  </ul>
</li>



@endif

