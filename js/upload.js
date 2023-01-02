function main(){
  console.log('--> upload.js')

  let uploadFile = document.getElementById('fileToUpload');
  let showFile = document.getElementById('file-selected');

  uploadFile.addEventListener('change', function() {
    let fileName = '';
    console.log('--> ', this.files)
    fileName = this.files[0].name;
    showFile.innerHTML = fileName;
  })
}


document.addEventListener("DOMContentLoaded", main);