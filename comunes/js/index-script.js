$(document).ready(function(){
  //código a ejecutar cuando el DOM está listo para recibir instrucciones.
  $("#log").focus(function(){
    $("#nUsuario").removeClass("has-error");
  });
  $("#cl").focus(function(){
    $("#cUsuario").removeClass("has-error");
  });
  $("#log").keyup(function(){
    var valor = $("#log").val();
    if($("#log").val().length == 8 ){
      $("#log").val(valor+"-");
    }
  });
  $('.tooltip-demo').tooltip({
        selector: "[data-toggle=modal]",
        container: "body"
    });
  $("#rP").keyup(function(){
    var p = $("#p").val();
    var rP = $("#rP").val();
    if(p=="" || rP==""){
      $("#texto").text("Las Contraseñas no coinciden");
      $("#icPasswords").removeClass("fa-check-circle");
      $("#icPasswords").addClass("fa-times-circle");
      $("#passwords").removeClass("alert-success");
      $("#passwords").addClass("alert-danger");
    }else{
      if(p == rP ){
        $("#texto").text("Las Contraseñas coinciden");
        $("#icPasswords").removeClass("fa-times-circle");
        $("#icPasswords").addClass("fa-check-circle");
        $("#passwords").removeClass("alert-danger");
        $("#passwords").addClass("alert-success");
      }else{
        $("#texto").text("Las Contraseñas no coinciden");
        $("#icPasswords").removeClass("fa-check-circle");
        $("#icPasswords").addClass("fa-times-circle");
        $("#passwords").removeClass("alert-success");
        $("#passwords").addClass("alert-danger");
      }
    }
    $("#passwords").show();
  });
  $("#p").keyup(function(){
    var p = $("#p").val();
    var rP = $("#rP").val();
    if(p=="" || rP==""){
      $("#texto").text("Las Contraseñas no coinciden");
      $("#icPasswords").removeClass("fa-check-circle");
      $("#icPasswords").addClass("fa-times-circle");
      $("#passwords").removeClass("alert-success");
      $("#passwords").addClass("alert-danger");
    }else{
      if(p == rP ){
        $("#texto").text("Las Contraseñas coinciden");
        $("#icPasswords").removeClass("fa-times-circle");
        $("#icPasswords").addClass("fa-check-circle");
        $("#passwords").removeClass("alert-danger");
        $("#passwords").addClass("alert-success");
      }else if (p.length<6 || rP.length<6 ){
        $("#texto").text("Las Contraseñas no coinciden");
        $("#icPasswords").removeClass("fa-check-circle");
        $("#icPasswords").addClass("fa-times-circle");
        $("#passwords").removeClass("alert-success");
        $("#passwords").addClass("alert-danger");
      }
    }
    $("#passwords").show();

  });
  $("#dui").keyup(function(){
    var valor = $("#dui").val();
    if($("#dui").val().length == 8 ){
      $("#dui").val(valor+"-");
    }
  });
  $("#ver").click(function(){
    if($("#p").attr("type") == "password"){
      $("#p").prop("type","text");
      $("#icVer").removeClass("fa-eye");
      $("#icVer").addClass("fa-eye-slash");
    }else{
      $("#p").prop("type","password");
      $("#icVer").removeClass("fa-eye-slash");
      $("#icVer").addClass("fa-eye");
    }
  });
  $("#rVer").click(function(){
    if($("#rP").attr("type") == "password"){
      $("#rP").prop("type","text");
      $("#icRVer").removeClass("fa-eye");
      $("#icRVer").addClass("fa-eye-slash");
    }else{
      $("#rP").prop("type","password");
      $("#icRVer").removeClass("fa-eye-slash");
      $("#icRVer").addClass("fa-eye");
    }
  });

  //Para el cambio de contraseña
  $("#rP1").keyup(function(){
    var p = $("#p1").val();
    var rP = $("#rP1").val();
    if(p=="" || rP==""){
      $("#texto1").text("Las Contraseñas no coinciden");
      $("#icPasswords1").removeClass("fa-check-circle");
      $("#icPasswords1").addClass("fa-times-circle");
      $("#passwords1").removeClass("alert-success");
      $("#passwords1").addClass("alert-danger");
    }else{
      if(p == rP ){
        $("#texto1").text("Las Contraseñas coinciden");
        $("#icPasswords1").removeClass("fa-times-circle");
        $("#icPasswords1").addClass("fa-check-circle");
        $("#passwords1").removeClass("alert-danger");
        $("#passwords1").addClass("alert-success");
      }else{
        $("#texto1").text("Las Contraseñas no coinciden");
        $("#icPasswords1").removeClass("fa-check-circle");
        $("#icPasswords1").addClass("fa-times-circle");
        $("#passwords1").removeClass("alert-success");
        $("#passwords1").addClass("alert-danger");
      }
    }
    $("#passwords1").show();
  });
  $("#p1").keyup(function(){
    var p = $("#p1").val();
    var rP = $("#rP1").val();
    if(p=="" || rP==""){
      $("#texto1").text("Las Contraseñas no coinciden");
      $("#icPasswords1").removeClass("fa-check-circle");
      $("#icPasswords1").addClass("fa-times-circle");
      $("#passwords1").removeClass("alert-success");
      $("#passwords1").addClass("alert-danger");
    }else{
      if(p == rP ){
        $("#texto1").text("Las Contraseñas coinciden");
        $("#icPasswords1").removeClass("fa-times-circle");
        $("#icPasswords1").addClass("fa-check-circle");
        $("#passwords1").removeClass("alert-danger");
        $("#passwords1").addClass("alert-success");
      }else if (p.length<6 || rP.length<6 ){
        $("#texto1").text("Las Contraseñas no coinciden");
        $("#icPasswords1").removeClass("fa-check-circle");
        $("#icPasswords1").addClass("fa-times-circle");
        $("#passwords1").removeClass("alert-success");
        $("#passwords1").addClass("alert-danger");
      }
    }
    $("#passwords1").show();

  });
  $("#dui1").keyup(function(){
    var valor = $("#dui1").val();
    if($("#dui1").val().length == 8 ){
      $("#dui1").val(valor+"-");
    }
  });
  $("#ver1").click(function(){
    if($("#p1").attr("type") == "password"){
      $("#p1").prop("type","text");
      $("#icVer1").removeClass("fa-eye");
      $("#icVer1").addClass("fa-eye-slash");
    }else{
      $("#p1").prop("type","password");
      $("#icVer1").removeClass("fa-eye-slash");
      $("#icVer1").addClass("fa-eye");
    }
  });
  $("#rVer1").click(function(){
    if($("#rP1").attr("type") == "password"){
      $("#rP1").prop("type","text");
      $("#icRVer1").removeClass("fa-eye");
      $("#icRVer1").addClass("fa-eye-slash");
    }else{
      $("#rP1").prop("type","password");
      $("#icRVer1").removeClass("fa-eye-slash");
      $("#icRVer1").addClass("fa-eye");
    }
  });
});
