<template>
    <div id="circle">
        <div class="loader">
            <div class="loader">
                <div class="loader">
                    <div class="loader">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
export default {
    mounted()
    {  
        let me = this
		if(JSON.parse(localStorage.getItem('permisos'))==null)
		{
            let url =base+'/usuarios/selected';
			axios
			.get(url)
			.then(function(response)
			{
                localStorage.setItem('permisos',JSON.stringify({validate:true}));
                window.location=base+'/dashboard/encuesta/nueva'
			})
			.catch(function(response){
                console.warn(response);
			})
        }
        else{
            window.location=base+'/dashboard/encuesta/nueva'

        }
    }
}
</script>