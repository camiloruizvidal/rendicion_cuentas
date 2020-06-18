<template>
    <div class="row">
        <div class="col-md-12">
            <label for="id_rol">Rol</label>
            <select class="form form-control" name="id_rol" id="id_rol" v-model="id_rol" @change="permisionsLoad">
                <option value="">Seleccione</option>
                <option v-for="(users,index) in rolesArray" :key="index" :value="users.id">
                    {{users.description}}
                </option>
            </select>
        </div>
        <div class="container-fluid">
            <div class="row">
                <template v-for="(permisions,index) in permisionsArray">
                    <div class="col-md-3" :key="index">
                        <label :for="'input_'+permisions.nombre" style="font-size: 10px;">
                            <input type="checkbox" @change="changePermision(permisions)" v-model="permisions.value" :id="'input_'+permisions.nombre" :disabled="disabled">
                            {{permisions.nombre}}
                        </label>
                    </div>
                </template>        
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data()
    {
        return {
            disabled:false,
            base:'',
            id_rol:'',
            rolesArray:[],
            permisionsArray:[]
        }
    },
    methods: {
        rolesLoad()
        {
            let me = this;
            axios
            .get(me.base + '/usuarios/roles')
            .then(function(response){
                me.rolesArray=response.data;
            })
            .catch(function(response){})
        },
        changePermision(permisions)
        {
            let me = this;
            me.disabled=true;
            let url = base + '/usuarios/permistions/save';
            axios
            .post(url,
            {
                id_rol : me.id_rol,
                nombre : permisions.nombre,
                status : permisions.value
            })
            .then(async function(response){
                await me.permisionsLoad();
                me.disabled=false;
            })
            .catch(function(response){console.warn(response);me.disabled=false;})
        },
        async permisionsLoad()
        {
            let me = this;
            await axios
            .post(me.base + '/usuarios/permistions/all',{id_rol:me.id_rol})
            .then(function(response){
                me.permisionsArray=response.data;
            })
            .catch(function(response){})
        }
    },
    mounted()
    {
        let me  = this;
        me.base = base;
        me.rolesLoad();
    }
}
</script>