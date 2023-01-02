
let inputs = []

function main(){
  console.log('--> credentials.js')

  inputs = document.getElementsByTagName('input');
  Array.from(inputs).forEach(inp => inp.addEventListener('click', (e) => {
    inp.select()
  }))
}


document.addEventListener("DOMContentLoaded", main);
