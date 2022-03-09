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

  // *********
  // CHAPTER NAVIGATOR
  // **********

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
    const navCheck = document.getElementById('navigator-check') || false;
    if (navCheck != false) {
        if (window.matchMedia('(min-width: 80em)').matches) {
            document.getElementById('navigator-check').checked = true;   
        }
        window.addEventListener('resize', function() {
  
            if (window.matchMedia('(max-width: 80em)').matches) {
                document.getElementById('navigator-check').checked = false;
                console.log("checked false");
            } else {
                document.getElementById('navigator-check').checked = true;
                console.log("checked true");
            }
        }, true);
    }