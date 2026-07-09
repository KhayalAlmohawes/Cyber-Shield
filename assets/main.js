const dropdown = document.querySelector(".dropdown");
const moreBtn = dropdown.querySelector("button");

moreBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  dropdown.classList.toggle("active");
});

document.addEventListener("click", () => {
  dropdown.classList.remove("active");
});


const form = document.getElementById("reportForm");
    const successMessage = document.getElementById("successMessage");

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      successMessage.style.display = "block";
      form.reset();
    });