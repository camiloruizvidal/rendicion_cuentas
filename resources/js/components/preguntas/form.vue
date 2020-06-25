<template>
    <div>
        <template v-if="disabled">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Guardado</h4>
                    <p>Se ha guardado con éxito sus preguntas</p>
                    <hr>
                </div>
        </template>
        <template v-else>
            <form @submit.prevent="save()" class="form-encuesta">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title">Preguntas audiencia pública, rendición de cuentas 2019. EMPRESA SOCIAL DEL ESTADO E.S.E. POPAYÁN</h1>
                        </div>
                        <div class="col-md-12">
                            <label for="nombre">Nombre</label>
                            <input type="text" v-model="form.nombre" id="nombre" name="nombre" class="form form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email">Correo electrónico</label>
                            <input type="email" v-model="form.email" id="email" name="email" class="form form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="dirección">Dirección</label>
                            <input type="text" v-model="form.dirección" id="dirección" name="dirección" class="form form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="telefono">Número de teléfono</label>
                            <input type="number" v-model="form.telefono" id="telefono" name="telefono" class="form form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="pregunta">Registre su pregunta, inquietud u observación</label>
                            <textarea v-model="form.pregunta" id="pregunta" name="" class="form form-control" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <button class="btn btn-success" :disabled="disabled">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </template>
    </div>
</template>
<script>
export default {
    data()
    {
        return {
            disabled:false,
            form:{
                dirección: '',
                email:'',
                nombre:'',
                telefono:'',
                pregunta:'',
            }
        }
    },
    methods:{
        save()
        {
            if($('form').valid())
            {
                let me = this;
                console.log(me.form);
                axios
                .post(base+'/preguntassave',me.form)
                .then((response)=>{
                    if(response.data.validate)
                    {
                        me.disabled=true;
                    }
                })
                .catch((response)=>{
                    console.warn(response.response.data)
                })
            }
        }
    },
    mounted()
    {
        $('form').validate();
    }

}
</script>

<style>

</style>