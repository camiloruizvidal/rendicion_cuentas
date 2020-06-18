<template>
    <Form @save="guardar"></Form>
</template>

<script>
import Form from './form';
export default {
    data()
    {
        return{
            id:'',
            name:'',
            email:'',
            desabilitado:0,
            rol:'',
            arrayRoles:[],
            documento:'',
        }
    },
    components:{Form},
    methods:{
        datos()
        {
            let me=this;
            axios
            .get(base+'/usuarios/edit/'+me.id)
            .then(function (response) 
	        {
                var respuesta = response.data;
                me.name=respuesta.name;
                me.email=respuesta.email;
                me.arrayRoles=respuesta.roles;
                me.rol=respuesta.rol;
                me.documento=respuesta.documento;
                me.desabilitado=respuesta.isblocked;
                me.$swal().close();
	        })
	        .catch(function (error)
	        {
                console.warn(error);
                me.$swal().close();
	        });
        },
        guardar(data)
        {
            let me=this;
	        axios.post(base+'/usuarios/editSave/'+data.id,data).then(function (response) 
	        {
                if(response.data.validate)
                {
                    me.$swal({type: 'success',title: 'Guardado con éxito'});
                    me.$router.push('/dashboard/usuarios');
                }
                else{
                    me.$swal({type: 'error',title: 'Se generó un error al guardar'});
                    console.warn({error:response.data});
                }
	        })
	        .catch(function (error, msj)
	        {
                me.$swal({type: 'error',title: 'Se generó un error al guardar'});
	            console.warn(error, msj);
	        });
        }
    },
    mounted()
    {
        let me = this;
        me.$swal({
			title: "Cargando",   
            text: "Por favor espere un momento",
			showConfirmButton: false
		})
        me.id = me.$route.params.id;
        me.datos();
    }
}
</script>
