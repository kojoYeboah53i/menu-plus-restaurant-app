const overlay = document.querySelector("#overlay");
const closeBtn = document.querySelector("#close-modal");
var image = document.getElementById("image");
var cropper, reader, file;


//close modal
$("#close-modal").click(function (e) {
e.preventDefault();
cropper.destroy();
cropper = null;
overlay.classList.add("hidden");
});





//cancel cropping image
const cancelCrop= () =>{
cropper.destroy();
cropper = null;
overlay.classList.add("hidden");
}


//skip cropping image
const skipCrop= () =>{
reader = new FileReader();
reader.onload = function (e) {
    done(reader.result);
};
reader.readAsDataURL(file);
$("#selfImagePreview").show();
$("#selfUploadImageBlock").hide();
$("#selfUploadForm").submit();

}


// load image into cropper
const done =  (url) => {
  image.src = url;
  //lunch modal
  overlay.classList.remove("hidden");
  overlay.classList.add("flex");

  //cropper
  cropper = new Cropper(image, {
  aspectRatio: 1,
  viewMode: 3,
  preview: ".preview",
  });
};




//begin upload image process
const cropImage = async (id) => {
alert("cropImage");
var files = $('#profileUpload')[0].files;

id = id || "#selfImagePreview";


if (files && files.length > 0) {
file = files[0];

if (URL) {
done(URL.createObjectURL(file));
} 

}
}



const cropingImage = async (url_string, user_id) => {

canvas = cropper.getCroppedCanvas({
width: 160,
height: 160,
});

canvas.toBlob(function (blob) {
  url = URL.createObjectURL(blob);
  var reader = new FileReader();
  reader.readAsDataURL(blob);

  reader.onloadend = async function () {
    $('#profileUpload').attr("src", this.result);

    const load =  document.querySelector('.loading');
    load.classList.remove('hidden')
    
    
    try {
      const url = url_string
      srcToFile(this.result,'image.jpg','image/jpeg').then(async function(file){
        var fd = new FormData();
        fd.append("croppedImage", file);
        fd.append("user_id", user_id);
        const Response = await fetch(url, {
          method: 'POST',
          body: fd
        });
        const content = await Response.json();
        console.log({content})
 
        window.location.reload(true); 
        $("#selfImagePreview").show();
        $("#selfUploadImageBlock").hide();
      });
      
    } catch (error) {
      console.log(error)
    }
    
  }
});
}

function srcToFile(src, fileName, mimeType){
return (fetch(src)
    .then(function(res){return res.arrayBuffer();})
    .then(function(buf){return new File([buf], fileName, {type:mimeType});})
);
}