  // *********
  // Modal Window
  // **********

  // Get the modal
  var modal = document.getElementById("modal");

  // Get the button that opens the modal
  let id;
  const actionBtns = document.querySelectorAll(".actionButton");
  const catInput = document.getElementById("category-input");
  const catRows = document.querySelectorAll(".category-row");

  // Get the <span> element that closes the modal
  const okBtn = document.getElementById('ok-button');
  const cancelBtn = document.getElementById("cancel-button")

  okBtn.addEventListener('click', function () {
    const catName = catInput.value;
    if (catName == null || catName == '') {
      const modalError = document.getElementById('modal-error');
      modalError.innerText = "Input field is empty";
      return;
    }
    location.href = `category-save/${id}/${catName}`;

  })
  cancelBtn.addEventListener('click', function () {
    modal.style.display = "none";
  })
  actionBtns.forEach((button) =>
    button.addEventListener('click', function (e) {
      const dataSet = e.target.parentNode.parentNode.dataset;
      id = dataSet.id;
      catInput.setAttribute('value', dataSet.category);
      modal.style.display = "block";
    })
  );

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }