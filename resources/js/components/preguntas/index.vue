<template>
    <div>
        <table class="table table-hover">
            <thead>

            <tr>
                <th>nombre</th>
                <th>dirección</th>
                <th>email</th>
                <th>pregunta</th>
                <th>telefono</th>
            </tr>
            </thead>
            <tr v-for="(item,idx) in dataArray" :key="idx">
                <td>{{item.nombre}}</td>
                <td>{{item.dirección}}</td>
                <td>{{item.email}}</td>
                <td>{{item.telefono}}</td>
                <td>{{item.pregunta}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    data()
    {
        return {
            dataArray:[],
        }
    },
    methods:{
        loadData()
        {
            let me = this;
            axios
            .get(base+'/preguntas')
            .then((response)=>{
                if(response.data.validate)
                {
                    me.dataArray=response.data.data;
                }
            })
        }

    },
    mounted()
    {
        this.loadData();
    }
}
</script>