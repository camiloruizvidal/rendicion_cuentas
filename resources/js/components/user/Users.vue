<template>
    <div class="row" v-if="mostrar">
        <div class="col-md-12">
        <router-link :to="{ name: 'usersnew' }"  class="btn btn-success"><i class="fas fa-user-plus"></i> Nuevo usuario</router-link>
        <br>
        <br>
        </div>
        <div class="col-md-12">
        <table class="table table-hover" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>E-mail</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,idx) in arrayUsers" :key="user.id">
                    <td>{{idx+1}}</td>
                    <td>
                        <b-dropdown id="dropdown-1" text="Opciones" class="m-md-2">
                            <b-dropdown-item @click="editar(user.id)"><i class="fas fa-pencil-alt"></i> Editar</b-dropdown-item>
                            <b-dropdown-item @click="borrar(user)"><i class="fas fa-trash-alt"></i> Borrar</b-dropdown-item>
                            <b-dropdown-item @click="bloquear(user.id,(user.activo==1?0:1))"><i :class="'fas fa-user-'+(user.activo==1?'times':'check')"></i> {{user.activo==1?'Bloquear':'Activar'}}</b-dropdown-item>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item @click="restablecer(user.id)"><i class="fas fa-sync-alt"></i> Reiniciar contraseña</b-dropdown-item>
                        </b-dropdown>
                    </td>
                    <td>
                        {{user.nombre_primero}}
                        {{user.nombre_segundo}}
                        {{user.apellido_primero}}
                        {{user.apellido_segundo}}
                    </td>
                    <td>
                        {{user.documento}}
                    </td>
                    <td>
                        {{user.email}}
                    </td>
                    <td>
                        <span v-if="user.activo==0" style="color:#dc3545"><i class="fas fa-user-times"></i></span>
                        <span v-if="user.activo==1" style="color:#28a745"><i class="fas fa-user-check"></i></span>
                    </td>
                    
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            mostrar:false,
            arrayUsers:[]
        }
    },
    methods:{
        restablecer(id)
        {
            let me=this;
	        axios.post(base+'/usuarios/restablecer',{id:id}).then(function (response) 
	        {
                me.$swal({type: 'success',title: 'Contraseña reiniciada con éxito',text: 'Ahora la contraseña es el número de documento'});
	        })
	        .catch(function (error, msj)
	        {
	            console.error(error, msj);
	        });
        },
        bloquear(id,estado)
        {
            let me=this;
            let data = {id:id,estado:estado};
            let url  = base+'/usuarios/bloquear';
	        axios
            .post(url,data)
            .then(function (response) 
	        {
                me.list();
	        })
	        .catch(function (error, msj)
	        {
	            console.error(error, msj);
	        });
        },
        editar(id)
        {
            let me = this;
			me.$router.push('/dashboard/usuarios/edit/'+id);
        },
        list()
        {
            let me=this;
	        axios.get(base+'/usuarios').then(function (response) 
	        {
                var respuesta= response.data;
	            me.arrayUsers=respuesta.data;
	        })
	        .catch(function (error, msj)
	        {
	            console.warn(error, msj);
	        });
        },
        borrar(data)
		{
            let me = this;
				me.$swal({
					title: 'Borrando',
                    text: 'Va a borrar a "'+ data.nombre_primero + ' ' + data.nombre_segundo + ' ' + data.apellido_primero + ' ' + data.apellido_segundo +'" ¿Está seguro?',
					type: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Si, borralo',
					cancelButtonText: 'Cancelar'
				}).then((result) => 
				{
					if (result.value) 
					{
						axios.post('/usuarios/delete',{id:data.id}).then(function (response) 
						{
							me.list();
							me.$swal('Borrado','"'+ data.nombre_primero + ' ' + data.nombre_segundo + ' ' + data.apellido_primero + ' ' + data.apellido_segundo +'" ha sido borrado con éxito','success')
						})
					}
					else if (result.dismiss === "cancel")
					{
						me.$swal('Cancelado','No se ha eliminado a "'+ data.nombre_primero + ' ' + data.nombre_segundo + ' ' + data.apellido_primero + ' ' + data.apellido_segundo +'"','error')
					}
				})
			}
    },
	mounted() {
        if(this.permisos.rol!='admin')
        {
            window.location=base+'/dashboard/encuesta/nueva';
        }
        else{
            this.mostrar=true;
        }
        this.list();
	}
}
</script>
