const cha = document.querySelector(".cha"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        cha.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        cha.classList.remove("active");
    });
