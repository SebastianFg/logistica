@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <title>@yield('titulo', 'Logistica') | Roles</title>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('usuarios.crear')
                  <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAlta"> <i class="fa fa-plus"> Nuevo Rol</i> </button> 
                  @endcan
{{--                   <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>   --}}
                </div>

{{--                 <div class="col-md-3">
                  <button type="button" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar</i>  </button> 
                  <button type="button" id="btnLimpiar" class="btn btn-warning left"> <i class="fa fa-paint-brush"> Limpiar</i> </button> 
                </div> --}}
          </div>

          {{-- extiendo los modales --}}
          @extends('rolesPermisos/roles/modales/modal_alta_rol')
          @extends('rolesPermisos/roles/modales/modal_edicion_rol')
          @extends('rolesPermisos/roles/modales/modal_baja_rol')
         
           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Lista de roles</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12" >
                    <form class="navbar-form navbar-right pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text"  autocomplete="off" name="rolBuscado" class="form-control" placeholder="ingrese Rol">
                        </div>

                        <div class="form-group">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                        </div>
                         
                      </div>
                    </form>
                  </div>
                  <div class="row table-responsive">
                    
                      <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                        <thead>
                          <tr>

                            <th>Rol</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($lista_roles as $item)
                            @if(strpos(Auth::User()->roles,'Super Admin') == true )
                              <tr>
                                <td>{{ $item->name }}</td>
                               
                                <td>
                                  @can('usuarios.asignarRol')
                                    <button  data-toggle="modal" onclick="editarRol({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                  @endcan
                                   @can('usuarios.eliminarUsuario') <button  onclick="eliminarRol({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                   @endcan
                                
                                </td>
                              
                              </tr>
                            @endif
                            @if($item->name != 'Super Admin'  and strpos(Auth::User()->roles,'Super Admin') != true )
                              <tr>
                                <td>{{ $item->name }}</td>
                               
                                <td>
                                  @can('usuarios.asignarRol')
                                    <button  data-toggle="modal" onclick="editarRol({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                  @endcan
                                   @can('usuarios.eliminarUsuario') <button  onclick="eliminarRol({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                   @endcan
                                
                                </td>
                              
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                      @if($existe)
                        <div class="row">
                            {{ $lista_roles->appends(Request::all())->links() }}
                        </div>
                      @endif
                  </div>
                  </div>
                </div>
              </div>
                          </div>
          {{-- card --}}
          </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
  <!-- /.content -->
  </div>
  {{-- final --}}
</div>

@endsection

@section('javascript')
<!-- jQuery -->


<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

<script type="text/javascript">

  function editarRol(item){
    
    var id_nombre_rol = $('#id_rol').val(item.id),
        nombre_Rol = $('#id_nombre_rol').val(item.name);
    $('#idModalEdicion').modal('show');
  }
  function eliminarRol(item){
   // console.log(item)
    var id_nombre_rol = $('#id_rol_baja').val(item.id),
        nombre_Rol = $('#id_nombre_rol_baja').val(item.name);
    $('#idModalBaja').modal('show');
  }

</script>

@stop
<style type="text/css">
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}*/
.modal-body {
    position: relative;
    overflow-y: auto;
    max-height: 400px;
    padding: 15px;
}
</style>