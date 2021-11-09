const burger = document.querySelector("div.burger");
const sidebar = document.querySelector(".sidebar-mobile");
burger.addEventListener("click", () => {
                //Toggle Nav
                burger.classList.toggle("toggle");

                console.log("toogle")
                sidebar.classList.toggle("sidebar-mobile-active");
})

window.sandboxImageUpload = function (input, id) {
    // const cropedImage =  cropImage();
//   alert(12345);
  id = id || "#selfImagePreview";
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
          $(id).attr("src", e.target.result);
      };
      reader.readAsDataURL(input.files[0]);

        //ajax comes here



      $("#selfImagePreview").show();
      $("#selfUploadImageBlock").hide();
      $("#selfUploadForm_m").submit();
  }
};