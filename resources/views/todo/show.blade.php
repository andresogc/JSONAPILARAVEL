@extends('layouts.app')

@section('content')

<div>
    <div class="m-5">
        <h1 class="text-white-50 mb-4">ToDos de {{$userArray['name']}} </h1>
        <form  >
            @csrf
            <label for="nombre" class="card-title text-white-50 mb-4"></label>
            <input type="text" name="title" placeholder="Titulo..." id="title" required >
            <input type="text" name="userId" value="{{$userTodosArray[0]['userId']}}" id="userId" hidden required >
            <input class=" add btn btn-success " type="submit" value="AGREGAR TODO" id="add">
        </form>
    </div>
    <div class="row content">
        @foreach($userTodosArray as $todo )
   
            <div class="card-todo{{$todo['id']}} col-sm-4" style="width: 36rem;" id="item{{$todo['id']}}" >
                <div class="card bg-info m-3">
                    <div class="card-body">
                    <h5 class="card-title"><span class="text-white-50" >Title: </span> <span id="title{{$todo['id']}}"> {{$todo['title']}} </span></h5>
                        <div class="form-check m-4">
                            @if($todo['completed'])
                                <h6 class="text-white-50" > Estado:  <span class="" id="estado{{$todo['id']}}"> Completado</span></h6>
                            @elseif(!$todo['completed'])
                                <h6 class="text-white-50">  Estado:  <span class="" id="estado{{$todo['id']}}"> No Completado</span></h6>
                            @endif    
                        </div>
                        <span><a href=""> <input class="delete btn btn-danger" type="submit" value="ELIMINAR" id="delete" data-id="{{$todo['id']}}" ></a></span> 
                        <span><a href=""> <input class="edit btn btn-warning" type="submit" value="EDITAR" id="edit" data-id="{{$todo['id']}}"></a></span> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- modal edit -->
<div class="modal fade " id="editModal" tabindex="-1 role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white-50">
        <h5 class="modal-title text-white">EDITAR TODO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body bg-info" >
        
      <div class="container">
            <h1 class="text-white mb-4 p-4" > {{$userArray['name']}} </h1>

            <form   class="row">
                @csrf
                <div class="col-sm-12">
                    <label for="nombre" class="card-title text-white-50 mb-4"  ><h4 id="modal-titleid"> Title: </h4></label>
                    <input type="text" name="title" value="" required  id="modal-title">
                </div>
                <div class="col-sm-4">
                    <label for="completed" class="card-title text-white-50 mb-4"><h4 > Estado:</h4></label>
                    <select class="form-select" aria-label="Default select example" name="completed" id="modal-completed">
                        <option value="false" >No Completada</option>
                        <option value="true"  >Completada</option>
                    </select>
                </div>
                <input type="text" name="id" value="{{$userTodosArray[0]['id']}}" hidden required id="modal-id">
                <input type="text" name="userId" value="{{$userTodosArray[0]['userId']}}" hidden requered id="modal-userId">
                
                <div class="col-md-12 m-4">
                   
                </div>
            </form>
        </div>



      </div>
      <div class="modal-footer bg-dark ">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" value="Actualizar" class="btn btn-success m-4 " id="update"  >
      </div>
    </div>
  </div>
</div>

@endsection
@section("scripts")
<script type="text/javascript">
    $(document).ready(function(){
        //agregar un nuevo TODO
        $('#add').on("click",function(e){
            
            e.preventDefault();
            var title = $('#title').val();
            var userId = $('#userId').val();
            var completed = false;
            
            if(!title ){
                toastr.warning('Debe ingresar un titulo valido.','Error de envio',{timeout:10000},{"iconClass": 'customer-info'});
            }else{

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('save_todo')}}",
                    dataType: 'json',
                    data: {
                        title:title,
                        userId:userId,
                        completed:completed
                    },
                    success: function(response){
                        if(response){
                            $('#title').val('');
                            toastr.success('El TODO se ingreso correctamente.','Nuevo registro',{timeout:3000});
                            var completed;
                            if(response["completed"]){
                                completed="Completado";
                            }else{
                                completed="No completado";
                            }
                           
                            var nodo=`
                            <div class="card-todo{{$todo['id']}} col-sm-4" style="width: 36rem;">
                                <div class="card bg-info m-3">
                                    <div class="card-body">
                                    <h5 class="card-title"><span class="text-white-50" >Title: </span> <span id="title${response["id"]}"> ${response["title"]} </span></h5>
                                        <div class="form-check m-4">
                                            @if($todo['completed'])
                                                <h6 class="text-white-50" > Estado:  <span class="" id="estado${response["id"]}"> ${completed}</span></h6>
                                            @elseif(!$todo['completed'])
                                                <h6 class="text-white-50">  Estado:  <span class="" id="estado${response["id"]}"> No Completado</span></h6>
                                            @endif    
                                        </div>
                                        <span><a href=""> <input class="btn btn-danger" type="submit" value="ELIMINAR" id="delete" ></a></span> 
                                        <span><a href=""> <input class="edit btn btn-warning" type="submit" value="EDITAR" id="edit" data-id="${response["id"]}"></a></span> 
                                    </div>
                                </div>
                            </div>
                                    
                            `   ;

                            $( ".content" ).append( nodo );
                        
                        }
                        
                        
                    },
                    error: function (response){
                        console.log(response);
                    }
                });
            }
    
        })


        //cargar datos en modal de edicion 
        $(".edit").on("click",function(e){
            e.preventDefault();
            var id = $(this).attr("data-id");
           
		    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
			});
			$.ajax({
                type: "GET",
                url: `{{url('get_todo/${id}')}}`,
                dataType: 'json',
                data: {id:id},
				
                success: function(response){
                    var complete;
                    if(response.completed){
                        completed=true;
                    }else{
                        completed=false;
                    }


					$("#modal-title").val(response.title);
                    $("#modal-completed option[value="+ completed +"]").attr("selected",true);
					$("#modal-id").val(response.id);
					$("#modal-userId").val(response.userId);
					$("#editModal").modal("show");
                },
	
				
                error: function (response){
                    console.log(response);
                }
            });
	    });

        //guardar edicion de TODO

        $('#update').on("click",function(e){
            
            e.preventDefault();

            var id = $("#modal-id").val();
            var title = $('#modal-title').val();
            var userId = $('#modal-userId').val();
            var completed = $('#modal-completed').val();
            
            if(!title ){
                toastr.success('Debe ingresar un titulo valido.','Error de envio',{timeout:3000});
            }else{

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('update_todo')}}",
                    dataType: 'json',
                    data: {
                        title:title,
                        userId:userId,
                        completed:completed,
                        id:id
                    },
                    success: function(response){
                        console.log(response)
                        if(response){
                            $('#title').val('');
                            toastr.success('El TODO se actualizo correctamente.','Actualizar registro',{timeout:3000});
                            var completed;
                            if(response["completed"] =="true"){
                                completed="Completado";
                            }else if(response["completed"]=="false"){
                                completed="No completado";
                            }
                        }
                            
                        $(`#title${id}`).text(response['title']);
                        $(`#estado${id}`).text(completed);

                        $("#editModal").modal("toggle");
                    },
                    error: function (response){
                        console.log(response);
                    }
                });
            }
    
        })


         //eliminar TODO
         $(".delete").on("click",function(e){
            e.preventDefault();
            var id = $(this).attr("data-id");
           
		    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
			});
			$.ajax({
                type: "POST",
                url: `{{route('delete_todo')}}`,
                dataType: 'json',
                data: {id:id},
				
                success: function(response){

                    $(`#item${response['id']}`).remove()

                    toastr.success('El TODO se elimino correctamente.','Eliminar registro',{timeout:3000});
					
                },
	
				
                error: function (response){
                    console.log(response);
                }
            });
	    });


    });


</script>

@endsection