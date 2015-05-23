/**
 * [getItem funcion para tomar la carrera en sesion del navegador]
 * @return {string} [UserCarreara es el id de la carrera en sesión]
 */
function getItem(){
  console.log(sessionStorage.getItem('ZessionImss'));
  console.log(sessionStorage.getItem('IdImss'));
}
/**
 * [getHost función para ir por la ubicación del sistema.]
 * @return {[string]} [regresa la ruta raiz]
 */
function getHost() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return host = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
   
}
/**
 * [sesionTry verifica si existe alguna sesion en este momento]
 *  * @return none
 */
function sesionTry(){
  if(sessionStorage.getItem('ZessionImss')!=1)
    {
         window.location.replace(getHost()); 

    }
}
/**
 * [sesionTry verifica si existe alguna sesion en este momento]
 *  * @return none
 */
function sesionTryInicio(){
  if(sessionStorage.getItem('ZessionImss')=='1')
    {
         window.location.replace(getHost()+"biopsia.html"); 

    }
}
/**
 * [logOut funcion para limpiar variable de sesión]
 * @return {none} [no regresa nada, solo cambia la ruta actual]
 */
function logOut() {
          sessionStorage.setItem("ZessionImss",null);
          sessionStorage.setItem("IdImss",null);
          window.location.replace(getHost());

  }
  /**
 * [tryLogin envia al archivo login carrera y el password para iniciar sesiÃ³n]
 * @param  {[int]} UserCarrera  [Id de la carrera seleccionada en el formulario]
 * @param  {[int]} UserPassword [El value del campo password introducido en el formulario]
 * @return {[int]}              [estado, 1 sesiÃ³n correcta,0 sesiÃ³n fallida]
 */
function tryLogin(Matricula){
        var host = getHost();
        var x={Matricula:Matricula};
        console.log(x);
        var url = host+'biopsia.html';
        console.log(host);
       var req = $.ajax({
                    type: "POST",
                    dataType: "json",
                    timeout : 10000,
                    beforeSend: function() { },
                    url: host+"php/login.php", 
                    data: x,
                    success: function(data) {
                                    if(data['Tipo']==2){
                                          sessionStorage.setItem("ZessionImss",'1');
                                          sessionStorage.setItem("IdImss",data['id'] );
                                          window.location.replace(url);
                                       }
                                    else if(data['estado']==0)
                                            { 
                                                document.getElementById('alerts').innerHTML="<span class='label label-danger'>Verifique su matricula</span></br></br>"
                                            }
                                    else if(data['estado']==1)
                                            { 
                                                document.getElementById('alerts').innerHTML="<span class='label label-danger'>Contacte al su encargado</span></br></br>"
                                            }
                                        }, 
                    error: function() {
                            //do something
                          }
    });
    req.success(function(){    });
    req.error(function(){ document.getElementById('alerts').innerHTML="<span class='label label-danger'>Verifique su matricula.</span></br></br>" });
}
/**
 * [login toma los valores]
 * @return {[none]} [nada]
 */
function login(){
    var Matricula =  document.getElementById('Matricula').value;
    if(Matricula==""){ //si el campo matricula esta vacio
            document.getElementById('alerts').innerHTML="<span class='label label-danger'>Debe de introducir una matricula</span></br></br>";
        }
    else{
          document.getElementById('alerts').innerHTML="</br></br>";
          tryLogin(Matricula);
      }
  }