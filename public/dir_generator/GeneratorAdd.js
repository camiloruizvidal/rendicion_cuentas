var fnData=Object;
var direcciones = {
    direccion: '',
    direccion_observacion: '',
    modal: '',
    iframe: ''
};
function url(data)
{
    var f=new Date();
    var rand=f.getDate()+''+f.getMonth()+''+f.getFullYear()+''+f.getHours()+''+f.getMinutes()+''+f.getSeconds();
    let base = window.location.protocol+'//'+window.location.host;
    var res = base + '/dir_generator/diradd.html?rand='+rand+'&';
    $.each(data, function (index, value)
    {
        res = res + index + '=' + value + '&';
    });
    return res;
}
function GeneratorAdd()
{
    $('#' + direcciones.modal).modal('show');
    var configuracion = {
        fieldNamecallbackFunction: 'cerrarModal', //Nombre de la función global  llamada al cerrar el modal
        fieldNameNPNrequerido: 0, //Indica si es requerido el NPN
        activarBusqueda: 1, //1 para activar búsqueda, 0 para inhabilitarla y colocar una dirección nueva
        fieldNameDiv: "modalIngresoDireccion", //Id del div donde se colocará el modal
        fieldNameDireccion: direcciones.direccion, //Id del input donde se colocará la dirección estándar
        fieldNameDireccionAdicional: direcciones.direccion_observacion, //Id del input donde se colocará la información adicional de la dirección como apartamento, local, casa, ...
    };
    $('#' + direcciones.iframe).attr('src', (url(configuracion)));
    fnData.value=direcciones;
}
function cerrarModal()
{
    var direccion = $('#' + direcciones.iframe).contents().find("#hiden_direccion");
    var direccion_observacion = $('#' + direcciones.iframe).contents().find("#hiden_direccion_observacion");
    $('#' + direcciones.direccion_observacion).val(direccion_observacion.val());
    $('#' + direcciones.direccion).val(direccion.val());
    $('#' + direcciones.direccion).trigger('change');
    $('#' + direcciones.direccion_observacion).trigger('change');
    $('#' + direcciones.modal).modal('hide');
}
$(function ()
{
    fnData = $.fn.extend({
        add_generator: function (data)
        {
            direcciones.modal = 'MyModal_dir';
            direcciones.iframe = 'iframe_dir';
            direcciones.direccion = data.direccion;
            direcciones.direccion_observacion = data.complemento;
            $('#' + direcciones.direccion + ',#' + direcciones.direccion_observacion).attr('style', 'background-color: #FFF;cursor: pointer;');
            $('#' + direcciones.direccion + ',#' + direcciones.direccion_observacion).attr('readonly', 'true');
            $('body').append(`<div class="modal fade" id="${direcciones.modal}" tabindex="-1" role="dialog" aria-labelledby="${direcciones.modal}">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="min-width: 652px;min-height:450px">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <center><iframe scrolling="no" id="${direcciones.iframe}" style="width: 550px;height: 450px; border:none;" src=""></iframe></center>
                        </div>
                    </div>
                </div>
            </div>
            </div>`);
            $(this).click(function ()
            {
                GeneratorAdd();
            });
        }
    });
});