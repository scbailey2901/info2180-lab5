window.onload=function(){

  var rTable=document.querySelector("#result");
  var btn= document.querySelector('#lookup')
  var httpRequest= new XMLHttpRequest();
  btn.addEventListener("click", function(element){
    element.preventDefault();
    var country=document.querySelector('#country').value;
    var url = "http://localhost/info2180-lab5/world.php?country="+country;

    httpRequest.onreadystatechange=loadTable;
    httpRequest.open('GET',url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('name=' + encodeURIComponent(country) );
  });

  function loadTable(){
    if (httpRequest.readyState === XMLHttpRequest.DONE){
      if (httpRequest.status===200){
        var response=httpRequest.responseText;
        rTable.innerHTML="";
        rTable.innerHTML=response;
      }else{
        console.log('Error. There was a problem with the request.')
      }
    }
  }
}