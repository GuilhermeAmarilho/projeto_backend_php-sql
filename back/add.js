let addconv = document.querySelector("#maisbutton");
let divconv = document.querySelector('.grupoconv');
console.log(divconv);
let conv1 = document.querySelector('.conv');
let tiraconv = document.querySelector("#menosbutton");


addconv.addEventListener('click', function (e){
  let conv2 = document.querySelector('.conv');
  console.log(conv2);
  let cln = conv2.cloneNode(true);
  cln.className="form-control conv";
  cln.name = "conv" +  (parseInt(conv2.name.substr(4,conv2.length))+1);

  divconv.appendChild(cln);
  conv2.className = "form-control";
  e.preventDefault();
});
tiraconv.addEventListener('click', function (e) {
    if (divconv.childElementCount > 3) {
      var div = divconv.lastChild;
      divconv.removeChild(div);
      div.disabled = false;
      }
  
      var div = divconv.lastChild;
      div.className = "form-control conv";
  
    e.preventDefault();
  })

