var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}

function currentDiv(n) {
  showDivsProd(slideIndex = n);
}

function showDivsProd(n) {
  var i;
  var x = document.getElementsByClassName("mySlidesProd");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}

document.querySelectorAll('.delete-form').forEach(form => {
  form.addEventListener('submit', function(e) {
      const confirmDelete = confirm('Tem certeza que deseja excluir este produto?');
      if (!confirmDelete) {
          e.preventDefault();
      }
  });
});

document.querySelectorAll('.edit-form').forEach(form => {
  form.addEventListener('submit', function(e) {
      const confirmDelete = confirm('Tem certeza que deseja submeter as alterações?');
      if (!confirmDelete) {
          e.preventDefault();
      }
  });
});

function toggleForm(formId) {
  var form = document.getElementById(formId);
  var formRow = document.getElementById("edit-form-row-" + formId.split('-')[2]); // Extracting product ID from formId
  if (form.style.display === "none") {
      form.style.display = "block";
      formRow.style.display = "table-row";
  } else {
      form.style.display = "none";
      formRow.style.display = "none";
  }
}
