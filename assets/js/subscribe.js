  // *********
  // Subscribe window
  // **********

  const subscrBtn  = document.getElementById('subscribe-button');
const modalSub = document.getElementById('subscribe-float');
  subscrBtn.addEventListener('click', (e) => {
      modalSub.style.display = "block";
      modalSub.style.opacity = 1;
  })

  // When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalSub) {
      modalSub.style.display = "none";
    }
  } 