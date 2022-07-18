/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./assets/js/subscribe.js ***!
  \********************************/
// *********
// Subscribe window
// **********
var subscrBtn = document.getElementById('subscribe-button');
var modalSub = document.getElementById('subscribe-float');
subscrBtn.addEventListener('click', function (e) {
  modalSub.style.display = "block";
  modalSub.style.opacity = 1;
}); // When the user clicks anywhere outside of the modal, close it

window.onclick = function (event) {
  if (event.target == modalSub) {
    modalSub.style.display = "none";
  }
};
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoic3Vic2NyaWJlLmpzIiwibWFwcGluZ3MiOiI7Ozs7O0FBQUU7QUFDQTtBQUNBO0FBRUEsSUFBTUEsU0FBUyxHQUFJQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0Isa0JBQXhCLENBQW5CO0FBQ0YsSUFBTUMsUUFBUSxHQUFHRixRQUFRLENBQUNDLGNBQVQsQ0FBd0IsaUJBQXhCLENBQWpCO0FBQ0VGLFNBQVMsQ0FBQ0ksZ0JBQVYsQ0FBMkIsT0FBM0IsRUFBb0MsVUFBQ0MsQ0FBRCxFQUFPO0FBQ3ZDRixFQUFBQSxRQUFRLENBQUNHLEtBQVQsQ0FBZUMsT0FBZixHQUF5QixPQUF6QjtBQUNBSixFQUFBQSxRQUFRLENBQUNHLEtBQVQsQ0FBZUUsT0FBZixHQUF5QixDQUF6QjtBQUNILENBSEQsR0FLQTs7QUFDRkMsTUFBTSxDQUFDQyxPQUFQLEdBQWlCLFVBQVNDLEtBQVQsRUFBZ0I7QUFDN0IsTUFBSUEsS0FBSyxDQUFDQyxNQUFOLElBQWdCVCxRQUFwQixFQUE4QjtBQUM1QkEsSUFBQUEsUUFBUSxDQUFDRyxLQUFULENBQWVDLE9BQWYsR0FBeUIsTUFBekI7QUFDRDtBQUNGLENBSkgsQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qcy9zdWJzY3JpYmUuanMiXSwic291cmNlc0NvbnRlbnQiOlsiICAvLyAqKioqKioqKipcbiAgLy8gU3Vic2NyaWJlIHdpbmRvd1xuICAvLyAqKioqKioqKioqXG5cbiAgY29uc3Qgc3Vic2NyQnRuICA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdWJzY3JpYmUtYnV0dG9uJyk7XG5jb25zdCBtb2RhbFN1YiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdWJzY3JpYmUtZmxvYXQnKTtcbiAgc3Vic2NyQnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKGUpID0+IHtcbiAgICAgIG1vZGFsU3ViLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XG4gICAgICBtb2RhbFN1Yi5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgfSlcblxuICAvLyBXaGVuIHRoZSB1c2VyIGNsaWNrcyBhbnl3aGVyZSBvdXRzaWRlIG9mIHRoZSBtb2RhbCwgY2xvc2UgaXRcbndpbmRvdy5vbmNsaWNrID0gZnVuY3Rpb24oZXZlbnQpIHtcbiAgICBpZiAoZXZlbnQudGFyZ2V0ID09IG1vZGFsU3ViKSB7XG4gICAgICBtb2RhbFN1Yi5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgfVxuICB9ICJdLCJuYW1lcyI6WyJzdWJzY3JCdG4iLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwibW9kYWxTdWIiLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInN0eWxlIiwiZGlzcGxheSIsIm9wYWNpdHkiLCJ3aW5kb3ciLCJvbmNsaWNrIiwiZXZlbnQiLCJ0YXJnZXQiXSwic291cmNlUm9vdCI6IiJ9