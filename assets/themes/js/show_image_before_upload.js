// show image before upload
function showImageBeforeUpload (elementInputFileID, elementShowImageID, widthImage) {
  let image_input = document.querySelector(elementInputFileID);
  image_input.addEventListener("change", function() {
    let reader = new FileReader();
    reader.addEventListener("load", () => {
      let uploaded_image = reader.result;
      document.querySelector(elementShowImageID).innerHTML = '<img src="'+ uploaded_image +'" width="'+widthImage+'" height="auto" />';
      document.querySelector(elementShowImageID).style.display = 'block';
    });
    reader.readAsDataURL(this.files[0]);
  });
}