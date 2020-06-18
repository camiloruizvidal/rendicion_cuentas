<template>
</template>
<script>
  export default {
    data(){
      return {
        base:''
      }
    },
    methods: 
    {
      async start()
      {
        let me = this;
        let url =base+'/usuarios/selected';
        axios
        .get(url)
        .then(function(response)
        {
          localStorage.setItem('permisos',JSON.stringify(response.data));
          localStorage.setItem('user',JSON.stringify(response.data));
          localStorage.setItem('name',JSON.stringify( ((response.data.nombre_primero==null)?'':response.data.nombre_primero)+' '+((response.data.apellido_primero==null)?'':response.data.apellido_primero)));
          window.location=base+'/dashboard/encuesta/index';
        })
        .catch(function(response){
          console.warn(response);
        })
      },
    },
    async mounted()
    {
      let me = this;
      me.base = base;
      me.start();
    }
  } 
</script>