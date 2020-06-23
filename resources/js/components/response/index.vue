<template>
    <div>
        <template v-if="disabled">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Guardado</h4>
                <p>Se ha guardado con éxito la encuesta</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </template>
        <template v-else>

            <form v-on:submit.prevent="save" v-if="data!=[]" class="form-encuesta">
                <h1 class="title">{{data.titulo}}</h1>
                <div v-for="(item,idx) in data.tbl_encuestas_preguntas" :key="idx">
                    <h4 class="question">{{item.pregunta}}</h4>
                    <template  v-for="(item2,idx2) in item.tbl_encuestas_respuestas" >
                    <label :key="idx2">
                        <table>
                            <tr>
                                <td><input type="radio" v-model="resultado.respuestas[idx].respuesta"  :value="item2.id" :name="'name'+idx" :required="idx2==0"></td>
                                <td><span class="answer">{{item2.respuestas}}</span></td>
                            </tr>
                        </table>
                    </label>
                    <br>
                    </template>
                </div>
                <button class="btn btn-success" :disabled="disabled">Enviar</button>
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
            name:'',
            data:[],
            resultado:{
                encuesta_id:'',
                respuestas:[]
            }
        }
    },
    methods:{
        save()
        {
            if($('form').valid())
            {
                let me = this;
                me.disabled=true;
                axios
                .post(base+'/encuestas/save',me.resultado)
            }
        },
        loadData()
        {
            let me = this;
            axios
            .get(base+'/encuestas/show/'+me.name)
            .then((response)=>{
                if(response.data.validate)
                {
                    me.data = response.data.data;
                    me.resultado.encuesta_id=me.data.id;
                    me.data.tbl_encuestas_preguntas.forEach((value)=>{
                        me.resultado.respuestas.push({
                            id_pregunta:value.id,
                            respuesta:''
                        });
                    });
                    console.log(me.resultado);
                }
            })
        }
    },
    mounted()
    {
        $('form').validate();
        this.name = (this.$route.params.name);
        this.loadData();
    }
}
</script>