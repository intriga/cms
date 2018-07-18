
function validarIngreso(){

  var expression = /^[a-zA-Z0-9]*$/;

  if(!expression.test($("#usuarioIngreso").val())) {
    return false;
  }

  if(!expression.test($("#passwordIngreso").val())) {
    return false;
  }

  return true;
}
