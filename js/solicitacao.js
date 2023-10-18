let select_tipo_procedimento =  document.getElementById("tipo-solicitacao");
let div_procedimento =  document.getElementById("div-procedimento");
let profissional =  document.getElementById("profissional");
let botao =  document.getElementById("enviar");
let procedimento =  document.getElementById("procedimento");

profissional.addEventListener("click",verificaSelecao);
select_tipo_procedimento.addEventListener("click",verificaSelecao);

function verificaSelecao(){
  if(profissional.value == "" || select_tipo_procedimento.value == ""){
  }else{
    updateForm(select_tipo_procedimento.value,profissional.value);
  }

}




function updateForm(val1,val2){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        div_procedimento.innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","pesquisa.php?q="+val1+"&s="+ val2,true);
    xmlhttp.send();
}