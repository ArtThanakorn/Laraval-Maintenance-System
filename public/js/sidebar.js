let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".menu-close");
// console.log(sidebarBtn);
if (sidebarBtn) { // Check if element exists
  sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
} else {
  console.log("Element with class 'bx-menu' not found");
}

