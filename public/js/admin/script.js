
function toggleSubmenu(submenus) 
{
  var submenu = document.getElementById(submenus);
  if (submenu.style.display === "block") 
  {
    submenu.style.display = "none";
  } 
  else 
  {
    submenu.style.display = "block";
  }
}


function toggleCaret() {
  var caretIcon = document.getElementById("caret");

  if (caretIcon.classList.contains("fa-caret-down")) 
  {
      caretIcon.classList.remove("fa-caret-down");
      caretIcon.classList.add("fa-caret-up");
  } else
   {
      caretIcon.classList.remove("fa-caret-up");
      caretIcon.classList.add("fa-caret-down");
   }
}
document.addEventListener("DOMContentLoaded", 
      function () 
   {
      var menuItems = document.querySelectorAll('.appointments');
      menuItems.forEach(function (item) 
      {
          item.addEventListener('click', function () 
          {
              menuItems.forEach(function (otherItem) 
              {
                  otherItem.classList.remove('active');
              });
              this.classList.add('active');
          });
      });
  });

  var btnContainer = document.getElementsByClassName("menu");
  var btns = btnContainer.getElementsByClassName("appointments");
  for (var i = 0; i < btns.length; i++)
 {
   btns[i].addEventListener('click', function ()
  {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active");
    this.className += " active";
  })
}









