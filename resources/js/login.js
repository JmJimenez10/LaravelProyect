const darkTheme = () => {
    document.querySelector("body").setAttribute("data-bs-theme", "dark");
    document.querySelector("#dl-icon").setAttribute("class", "fa-solid fa-sun");

    document.querySelector("form").classList.add("bg-dark");
    document.querySelector("form").classList.remove("bg-white");

    localStorage.setItem('themePreference', 'dark');
}

const lightTheme = () => {
    document.querySelector("body").setAttribute("data-bs-theme", "light");
    document.querySelector("#dl-icon").setAttribute("class", "fa-solid fa-moon");

    document.querySelector("form").classList.remove("bg-dark");
    document.querySelector("form").classList.add("bg-white");

    localStorage.setItem('themePreference', 'light');
}

const changeTheme = () => {
    document.querySelector("body").getAttribute("data-bs-theme") == 'light'?
    darkTheme() : lightTheme();

    changeBg();
}

function changeBg() {
    var theme = document.querySelector("body").getAttribute("data-bs-theme");
    if (theme == "light") {
        document.querySelector("body").style.backgroundImage = "url(../../images/loginLight.svg)";
    } else {
        document.querySelector("body").style.backgroundImage = "url(../../images/loginDark.svg)";
    }
};

window.onload = () => {
    const themePreference = localStorage.getItem('themePreference');
    if (themePreference) {
        themePreference === 'dark' ? darkTheme() : lightTheme();
        changeBg();
    }
};

const showAlert = () => {
    document.querySelector("#alert").classList.remove("d-none");
}

const password = document.getElementById("password");
const icon = document.querySelector(".bx");

icon.addEventListener("click", e => {
  if (password.type === "password") {
    password.type = "text";
    icon.classList.remove("bx-show");
    icon.classList.add("bx-hide");
  } else {
    password.type = "password";
    icon.classList.add("bx-show");
    icon.classList.remove("bx-hide");
  }
});
