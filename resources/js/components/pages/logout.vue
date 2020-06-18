<template>
  
</template>

<script>
export default {
    mounted()
    {
        localStorage.clear();
        window.location = base + "/logout";

    }
}
</script>