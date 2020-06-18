<template>
    <Form @save="guardar"></Form>
</template>

<script>
import Form from './form';
export default {
    data()
    {
        return{}
    },
	components:{Form},
    methods:{
        
        guardar(data)
        {
            let me=this;
	        axios.post(base+'/usuarios/newsave/',data).then(function (response) 
	        {
                me.$swal({type: 'success',title: 'Guardado con éxito'});
                me.$router.push('/dashboard/usuarios');
	        })
	        .catch(function (error, msj)
	        {
                me.$swal({type: 'error',title: 'Se presento un error al guardar'});
	            console.error(error.response, msj);
	        });
        }
    },
    mounted()
    {
        let me = this;
    }
}
</script>
