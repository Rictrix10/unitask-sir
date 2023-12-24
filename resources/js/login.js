document.getElementById("showPasswordBtn").addEventListener("click", function() {
    var passwordInput = document.getElementById("signup-password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  });