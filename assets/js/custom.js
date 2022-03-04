  // *********
  // NAVMENU
  // **********
  const btnNav = document.querySelector(".btn-mobile-nav");
  const navParent = document.getElementById('nav-parent');
  if (btnNav != null) {
  btnNav.addEventListener("click", function () {
    navParent.classList.toggle("nav-open");
  });
  }

  /* CHAPTER NAVIGATOR 
  */

const sidebarChapters = document.getElementById('sidebar-chapters');
const navigatorContent = document.getElementById('navigator-content');
const chaptersCollection = document.getElementsByClassName('navigator-chapter');

for (let chapter of chaptersCollection) {

    const anchor = document.createElement('a');
    const label = document.createTextNode(chapter.innerHTML);
  
    anchor.appendChild(label);
    anchor.setAttribute('href', '#' + chapter.id);
    anchor.classList.add('sidebar-chapter__link');
    sidebarChapters.appendChild(anchor);

}
// SMOOTH SCROLLING 
// https://stackoverflow.com/a/7717572/1496972
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

/* check if screen resizes, than check/uncheck input
*  if screen size < 80em sidebar is hidden
*  if bigger (desktop) than show sidebar
*  it's based on:
*  https://stackoverflow.com/a/46438472/1496972 
*/
if (window.matchMedia('(min-width: 80em)').matches) {
    document.getElementById('navigator-check').checked = true;   
  
}
window.addEventListener('resize', function() {
  
    if (window.matchMedia('(max-width: 80em)').matches) {
        if (document.body.contains('navigator-check')) {
        document.getElementById('navigator-check').checked = false;
        }
        console.log("checked false");
    } else {
        document.getElementById('navigator-check').checked = true;
        console.log("checked true");
    }
}, true);


/*
*  Modal window
*/


console.log("testujemy00");
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

okBtn.addEventListener('click', function() {
    const catName = catInput.value;
    console.log(catName);
    if (catName == null || catName == '') {
        const modalError = document.getElementById('modal-error');
        modalError.innerText = "Input field is empty";
        return;
    } 
    console.log(catName);
  
    location.href = `category-save/${id}/${catName}`;

})
cancelBtn.addEventListener('click', function() {
    console.log("Cancel");
    modal.style.display = "none";
})

actionBtns.forEach( (button) => 
        button.addEventListener('click', function(e) {
            const dataSet = e.target.parentNode.parentNode.dataset;
            id = dataSet.id;
            console.log(id);
            catInput.setAttribute('value', dataSet.category);
            modal.style.display = "block";
        
          
        }
    )
);

// When the user clicks on <span> (x), close the modal


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 