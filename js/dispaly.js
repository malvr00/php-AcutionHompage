const menuDisplayLI = document.querySelector(".status-bar_category"); // 부모 li
const menuDisplayUL = document.querySelector(".status-bar_category_m1"); // 자식 ul

function hoverEvnet(event) {
  menuDisplayUL.style.display = "block";
}

function nothoverEvnet(evnet) {
  menuDisplayUL.style.display = "none";
}
function init() {
  menuDisplayLI.addEventListener("mouseenter", hoverEvnet); // 마우스 올라 갔을 때
  menuDisplayLI.addEventListener("mouseleave", nothoverEvnet); // 마우스 떠났을 때
}

init();
