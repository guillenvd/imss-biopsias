function buscarPaciente() {
        $('#btn-imprimir').removeAttr('disabled');
    var host = getHost();
    var numero = document.getElementById('Numero').value;
    var afiliacion = document.getElementById('Afiliacion').value;
    var nombre = document.getElementById('Nombre').value;
    var fechaC = document.getElementById('FechaC').value;
    if(numero!=""||afiliacion!=""||nombre!=""||fechaC!=""){
                var x={numero:numero};
                console.log(x);
               var req = $.ajax({
                            type: "POST",
                            dataType: "json",
                            timeout : 10000,
                            beforeSend: function() { },
                            url: host+"php/conexionMDB.php", 
                            data: x,
                            success: function(data) {
                                            if(data==0){


                                        document.getElementById('alerts').innerHTML="<div class=\"alert alert-info\" role=\"alert\">"+
                                                        "<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>"+
                                                         "<span class=\"sr-only\">Error:</span>"+
                                                          " No se encontrarón Biopsias"+
                                                        "</div>";
                                                }
                                                else{                                            
                                                     document.getElementById('alerts').innerHTML="";
                                                      $.each(data, function(i,item){
                                                        document.getElementById('Numero').value=item.numero;
                                                        document.getElementById('Nombre').value=item.nombre;
                                                        document.getElementById('Edad').value=item.edad;
                                                        document.getElementById('Afiliacion').value=item.afiliacion;
                                                        document.getElementById('FechaC').value=item.fechaC;
                                                        document.getElementById('FechaR').value=item.fechaR;
                                                        document.getElementById('FechaE').value=item.fechaE;
                                                        document.getElementById('NumeroMemo').value=item.numeroMemo;
                                                        document.getElementById('Especimen').value=item.especimen;
                                                        document.getElementById('Medico').value=item.medico;
                                                        document.getElementById('datosClinico').innerHTML=item.datos;
                                                        document.getElementById('diagnostico').innerHTML=item.diagnostico;
                                                        document.getElementById('Microscopica').innerHTML=item.descripcionMicro;
                                                        document.getElementById('Macroscopica').innerHTML=item.descripcionMacro;
                                                        });      
                                              }
                                            }, 
                            error: function() {
                                    //do something
                                  }
            });
            req.success(function(){    });
            req.error(function(){ document.getElementById('alerts').innerHTML="<span class='label label-danger'>error ajax.</span></br></br>" });
           
    }
    else{
        $('#btn-imprimir').attr('disabled','true');
         document.getElementById('alerts').innerHTML="<div class=\"alert alert-danger\" role=\"alert\">"+
                                                        "<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>"+
                                                         "<span class=\"sr-only\">Error:</span>"+
                                                          " Rellene algún campo"+
                                                        "</div>";
    }
}
function imprimirBiopsia() {
$('#btn-imprimir').removeAttr('disabled');
    var host = getHost();
    var numero = document.getElementById('Numero').value;
    var afiliacion = document.getElementById('Afiliacion').value;
    var nombre = document.getElementById('Nombre').value;
    var fechaC = document.getElementById('FechaC').value;
    var Nombre = "Dra De cualquier nombre.";
    var Matricula = "12760328";
    if(numero!=""||afiliacion!=""||nombre!=""||fechaC!=""){        
        document.getElementById('alerts').innerHTML="";
        var url =  host+"php/pdf-generate.php?numero="+numero+"&Medico="+Nombre+"&Matricula="+Matricula;
        var win = window.open(url, '_blank');
        win.focus();
    }
    else{    document.getElementById('alerts').innerHTML="<div class=\"alert alert-danger\" role=\"alert\">"+
                                                        "<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>"+
                                                         "<span class=\"sr-only\">Error:</span>"+
                                                          " Rellene algún campo"+
                                                        "</div>";
            $('#btn-imprimir').attr('disabled','true');
}
        }
    