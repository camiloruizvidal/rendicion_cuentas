<template>
    <div style="text-align:center">
        <h1 style="font-size:10rem">403</h1>
        <img :src="base+'/images/denegado.png'" alt="">
        <h4>Uste no tiene acceso a esta información</h4>
    </div>
</template>

<script>
export default {
    data()
    {
        return{
            base:''
        }
    },
    mounted(){
        this.base = base;
    }
}
</script>