<template>
    <form v-if="mostrar" @submit.prevent="guardar">
            <div class="row">
                <div class="col-md-6">
                        <label>Tipo de documento</label>
                        <select class="form form-control" name="documento" id="documento" v-model="form.documento_tipo_id" required>
                            <option value="" style="display:none">Seleccione</option>
				            <option v-for="(item,idx) in arrayDocumentoTipo" :key="idx" :value="item.id">{{item.nombre}}</option>
                        </select>
                </div>
                <div class="col-md-6">
                        <label>Documento</label>
                        <input class="form form-control" name="documento" v-model="form.documento" id="documento" required/>
                </div>
                <div class="col-md-6">
                        <label>Primer nombre</label>
                        <input class="form form-control" name="nombre_primero" id="nombre_primero" v-model="form.nombre_primero" required>
                </div>
                <div class="col-md-6">
                        <label>Segundo nombre</label>
                        <input class="form form-control" name="nombre_segundo" id="nombre_segundo" v-model="form.nombre_segundo" >
                </div>
                <div class="col-md-6">
                        <label>Primer apellido</label>
                        <input class="form form-control" name="apellido_primero" id="apellido_primero" v-model="form.apellido_primero" required>
                </div>
                <div class="col-md-6">
                        <label>Segundo apellido</label>
                        <input class="form form-control" name="apellido_segundo" id="apellido_segundo" v-model="form.apellido_segundo" >
                </div>
                <div class="col-md-6">
                        <label>Correo electronico</label>
                        <input type="email" class="form form-control" name="email" id="email" v-model="form.email" required>
                </div>
                <div class="col-md-6">
                        <label>Dirección</label>
                        <input type="text" class="form form-control" name="direccion" id="direccion" v-model="form.direccion" required>
                </div>
                <div class="col-md-4">
                        <label>Celular</label>
                        <input type="text" class="form form-control" name="celular" id="celular" v-model="form.celular" required>
                </div>
                <div class="col-md-1">
                    <label for="isActive">Activo</label>
                    <b-form-checkbox v-model="form.activo" id="isActive" name="isActive" switch size="lg">
                    </b-form-checkbox>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success" :disabled="disabled"><i class="fa fa-save"></i> Guardar </button>
                </div>
            </div>
        </form>
</template>

<script>
export default {
    data()
    {
        return{
            mostrar:false,
            form:
            {
                id:'',
                nombre_primero:'',
                nombre_segundo:'',
                apellido_primero:'',
                apellido_segundo:'',
                email:'',
                documento:'',
                activo:true,
				documento_tipo_id:'',
                direccion:'',
            },
            arrayDocumentoTipo:[],
            arrayPuntosAtencion:[],
            disabled:false
        }
    },
    methods:{
        loadDocumentoTipo()
		{
			let me = this;
			axios
			.get(base+'/documentotipo')
			.then( (response) => {
				me.arrayDocumentoTipo = response.data.data;
			});
        },
        loadPuntosAtencion()
        {
            let me=this;
	        axios
            .get(base+'/puntosatencion/')
            .then(function (response) 
	        {
                var respuesta = response.data;
                me.arrayPuntosAtencion=respuesta;
	        })
	        .catch(function (error, msj)
	        {
	            console.error(error, msj);
	        });
        },
        guardar()
        {
            let me = this;
            me.disabled=true;
			if($('form').valid())
			{
                me.$emit('save', me.form);
                me.disabled=true;
            }
            else
            {
                me.disabled=false;
            }
        },
        loadUser()
        {
            let me = this;
            if(me.form.id!='')
            {
                axios.get(base+'/usuarios/edit/'+me.form.id).then(function (response) 
                {
                    me.form       = response.data.data;
                    me.form.rol   = response.data.data.roles[0].id;
                })
                .catch(function (error)
                {
                    console.error(error);
                });
            }
        },
    },
    mounted()
    {
        let me = this;
        if(this.permisos.rol!='admin')
        {
            window.location=base+'/dashboard/encuesta/nueva';
        }
        else{
            this.mostrar=true;
        }
        me.form.id =(typeof me.$route.params.id!='undefined')?me.$route.params.id:me.form.id;
        me.loadDocumentoTipo()
        me.loadUser();
        $('form').validate();
    }
}
</script>