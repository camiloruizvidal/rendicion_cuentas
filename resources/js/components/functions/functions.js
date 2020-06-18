const fn = {
    formatCurrency(value)
    {
        let miles=',';
        let decimales='.';
        let data = (typeof value == 'undefined' || value == null )?'0':value.toString();
        data = parseFloat(data.split(miles).join('')).toFixed(2);
        var out = '';
        var filtro = '-1234567890'+decimales;
        let decimal=true;
        for (var i=0; i<data.length; i++)
        {

            if (filtro.indexOf(data.charAt(i)) != -1) 
            {
                if(data.charAt(i)==decimales)
                {
                    if((data.split(decimales).filter( c => c != ' ' ).length-1)<=1)
                    {
                        out += data.charAt(i);        
                        decimal=false;
                    }
                    if (decimal)
                    {
                        decimal=false;
                        out += data.charAt(i);        
                    }
                }else{

                    out += data.charAt(i);
                }
            }
        }
        let returns=out.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1'+miles)
        return returns.split('.00').join('');
    },
    deleteFormatCurrency(value)
    {
        let miles=',';
        let decimales='.';
        let data = (typeof value == 'undefined' || value == null )?'0':value.toString();
        return parseFloat(parseFloat(data.split(miles).join('')).toFixed(2));
    },
    onlyNumbers(value)
    {
        let miles=',';
        let decimales='.';
        let data = (typeof value == 'undefined' || value == null )?'0':value.toString();
        data = parseFloat(data.split(miles).join('')).toFixed(2);
        var out = '';
        var filtro = '1234567890'+decimales;
        let decimal=true;
        for (var i=0; i<data.length; i++)
        {

            if (filtro.indexOf(data.charAt(i)) != -1) 
            {
                if(data.charAt(i)==decimales)
                {
                    if((data.split(decimales).filter( c => c != ' ' ).length-1)<=1)
                    {
                        out += data.charAt(i);        
                        decimal=false;
                    }
                    if (decimal)
                    {
                        decimal=false;
                        out += data.charAt(i);        
                    }
                }else{

                    out += data.charAt(i);
                }
            }
        }
        let number = out.split('.00').join('');
        return number;
    },
    onlyNumbersMax(value,maximun)
    {
        value = this.onlyNumbers(value);
        if(value.length>maximun)
        {
            value = value.substr(0,maximun);
        }
        return value
    },
    calcular_edad(fecha){

        var hoy=new Date()
        var array_fecha = fecha.split("-")
        var ano = parseInt(array_fecha[0]);
        var mes = parseInt(array_fecha[1]);
        var dia = parseInt(array_fecha[2]);
        let edad=hoy.getFullYear()- ano - 1;
        if (hoy.getMonth() + 1 - mes < 0)
           return edad
        if (hoy.getMonth() + 1 - mes > 0)
           return edad+1
        if (hoy.getUTCDate() - dia >= 0)
           return edad + 1
    
        return edad
    },
    onlyDate(fecha)
    {
        var f = new Date(fecha);
        return f.getFullYear() + "-" +((f.getMonth()+1)<10?'0':0) + (f.getMonth()+1) + "-" + (f.getDate()<10?'0':'')+(f.getDate())
    },
    onlyHour(fecha)
    {
        var f = new Date(fecha);
        let hora='';
        let AP=''
        if(f.getHours()==0)
        {
            hora = '00';
            AP='A.M'
        }
        else if(f.getHours()>12)
        {
            hora = f.getHours()-12
            hora=(hora<10?'0':'')+hora
            AP='P.M'
        }
        else if(f.getHours()==12)
        {
            AP='P.M'
        }
        else{
            hora = (f.getHours()<10?'0':'')+(f.getHours());
            AP='A.M'
        }
        return hora + ":" +(f.getMinutes()<10?'0':'') + (f.getMinutes()) + ":" + (f.getSeconds()<10?'0':'')+(f.getSeconds())+' '+AP
    },
}
export default fn;