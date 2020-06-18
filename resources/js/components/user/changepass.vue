<template>
<form @submit.prevent="guardar()">
        <div class="row">
            <div class="col-md-6">
                <label for="">Contraseña nueva</label>
                <input type="password" class="form form-control" v-model="form.pass1" id="pass1" name="pass1" required>
            </div>
            <div class="col-md-6">
                <label for="">Repita contraseña</label>
                <input type="password" class="form form-control" v-model="form.pass2" id="pass2" name="pass2" required>
            </div>

            <div class="col-md-6">
                <label for="">Email</label>
                <input type="email" class="form form-control" v-model="form.email" id="email" name="email" required>
            </div>
            <div class="col-md-6">
                <label for="">Contraseña anterior</label>
                <input type="password" class="form form-control" v-model="form.passold" id="passold" name="passold" required>
            </div>
            <div class="col-md-6">
                <br/>
                <button class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</template>
<script>
const Swal = require('sweetalert2')
export default {
    data()
    {
        return {
            base :'',
            form:{
                email:'',
                pass1:'',
                pass2:'',
                passold:''
            }
        }
    },
    methods:{
        siValida()
        {
            let me = this;
            me.validate=true;
            $.each(me.form,function(index,value){
                if(value==''){
                    me.validate=false;
                }
            });
            return me.validate;
        },
        guardar()
        {
            let me = this;
            if(me.siValida())
            {
                axios
                .post(me.base+'/usuarios/changepass',me.form)
                .then(function (response) 
                {
                    if(response.data.validate)
                    {
                        me.$swal(response.data.msj);
                    }
                    else{
                        me.$swal({
                            title: 'No hubo cambio',
                            text: response.data.msj
                        })
                    }
                })
                .catch(function(response){
                    console.warn(response)
                })
            }
        }
    },
    mounted()
    {
        $('form').validate();
        this.base = base;
    }

}
</script>
