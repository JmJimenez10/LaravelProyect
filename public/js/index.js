const darkTheme = () => {
  document.querySelector("body").setAttribute("data-bs-theme", "dark");
  document.querySelector("#dl-icon").setAttribute("class", "fa-solid fa-sun");

  document.querySelector("nav").classList.add("bg-dark");
  document.querySelector("nav").classList.remove("bg-white");

  localStorage.setItem("themePreference", "dark");
};

const lightTheme = () => {
  document.querySelector("body").setAttribute("data-bs-theme", "light");
  document.querySelector("#dl-icon").setAttribute("class", "fa-solid fa-moon");

  document.querySelector("nav").classList.remove("bg-dark");
  document.querySelector("nav").classList.add("bg-white");

  localStorage.setItem("themePreference", "light");
};

const changeTheme = () => {
  document.querySelector("body").getAttribute("data-bs-theme") == "light"
    ? darkTheme()
    : lightTheme();
};

window.onload = () => {
  const themePreference = localStorage.getItem("themePreference");
  if (themePreference) {
    themePreference === "dark" ? darkTheme() : lightTheme();
  }
};

const showAlert = () => {
  document.querySelector("#alert").classList.remove("d-none");
};

// Espera a que el DOM esté completamente cargado
// document.addEventListener("DOMContentLoaded", function () {
//   // Obtén todos los checkboxes
//   var checkboxes = document.querySelectorAll(".form-check-input");

//   // Recorre cada checkbox
//   checkboxes.forEach(function (checkbox) {
//     // Agrega un evento de clic a cada checkbox
//     checkbox.addEventListener("click", function () {
//       // Si el checkbox está marcado
//         // Obtén el valor del checkbox (que puede ser el índice en este caso)
//         var index = this.value;

//         // Realiza una solicitud AJAX al servidor PHP
//         var xhr = new XMLHttpRequest();
//         xhr.open("GET", "index.php?state=" + index, true);
//         xhr.send();
//     });
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  // Obtén todos los checkboxes
  var checkboxes = document.querySelectorAll(".form-check-input");

  // Recorre cada checkbox
  checkboxes.forEach(function (checkbox) {
    // Agrega un evento de clic a cada checkbox
    checkbox.addEventListener("click", function () {
      // Obtén el valor del checkbox (que es el ID de la nota)
      var noteId = this.value;

      // Obtén el estado del checkbox (marcado o no)
      var state = this.checked ? 'done' : 'pending';

      // Obtiene el token CSRF
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Realiza una solicitud AJAX al servidor para actualizar el estado de la nota
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/update-note-state", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken); // Incluye el token CSRF en la cabecera
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            // La solicitud se ha completado con éxito
            console.log("Estado de la nota actualizado correctamente");
          } else {
            // Ocurrió un error al procesar la solicitud
            console.error("Error al actualizar el estado de la nota");
          }
        }
      };
      xhr.send(JSON.stringify({ id: noteId, state: state }));
    });
  });
});





document.addEventListener('DOMContentLoaded', function() {
  var myModal = new bootstrap.Modal(document.getElementById('newNote'));

  // myModal.show();

  myModal._element.addEventListener('shown.bs.modal', function() {
      // Enfocar el input del título cuando se muestra el modal
      document.getElementById('tituloInput').focus();
  });
});
