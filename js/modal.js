const btns = document.querySelectorAll("[data-target]");
const close_modals = document.querySelectorAll(".close-modal");
const overlay = document.getElementById("overlay");

btns.forEach((ss) => {
  ss.addEventListener("click", () => {
    document.querySelector(ss.dataset.target).classList.add("active");
    overlay.classList.add("active");
  });
});

close_modals.forEach((ss) => {
  ss.addEventListener("click", () => {
    const modal = ss.closest(".modal");
    modal.classList.remove("active");
    overlay.classList.remove("active");
  });
});

window.onclick = (event) => {
  if (event.target == overlay) {
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => modal.classList.remove("active"));
    overlay.classList.remove("active");
  }
};
