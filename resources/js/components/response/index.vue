<template>
    <div>
            hola mundo
    </div>
</template>

<script>
export default {
    name:'encuesta',
    data()
    {
        return {
            name:'',

        }
    },
    methods:{
        loadData()
        {
            let me = this;
            axios
            .get(base+'/encuestas/show/'+me.name)
            .then((data)=>{
                console.log(response.data)
            })
        }
    },
    mounted()
    {
        this.name = (this.$route.params.name);
        this.loadData();
    }
}
</script>