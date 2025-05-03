// Form validation for registration
function validateRegistrationForm() {
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm_password").value;

  let isValid = true;
  let errorMessage = "";

  // Reset error messages
  document.getElementById("error-message").innerHTML = "";

  // Validate username
  if (username.trim() === "") {
    errorMessage += "Username is required.<br>";
    isValid = false;
  } else if (username.length < 3) {
    errorMessage += "Username must be at least 3 characters.<br>";
    isValid = false;
  }

  // Validate email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email.trim() === "") {
    errorMessage += "Email is required.<br>";
    isValid = false;
  } else if (!emailRegex.test(email)) {
    errorMessage += "Please enter a valid email address.<br>";
    isValid = false;
  }

  // Validate password
  if (password.trim() === "") {
    errorMessage += "Password is required.<br>";
    isValid = false;
  } else if (password.length < 6) {
    errorMessage += "Password must be at least 6 characters.<br>";
    isValid = false;
  }

  // Validate confirm password
  if (confirmPassword.trim() === "") {
    errorMessage += "Please confirm your password.<br>";
    isValid = false;
  } else if (password !== confirmPassword) {
    errorMessage += "Passwords do not match.<br>";
    isValid = false;
  }

  // Display error message if validation fails
  if (!isValid) {
    document.getElementById("error-message").innerHTML = errorMessage;
    document.getElementById("error-message").style.display = "block";
  }

  return isValid;
}

// Form validation for login
function validateLoginForm() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  let isValid = true;
  let errorMessage = "";

  // Reset error messages
  document.getElementById("error-message").innerHTML = "";

  // Validate username
  if (username.trim() === "") {
    errorMessage += "Username is required.<br>";
    isValid = false;
  }

  // Validate password
  if (password.trim() === "") {
    errorMessage += "Password is required.<br>";
    isValid = false;
  }

  // Display error message if validation fails
  if (!isValid) {
    document.getElementById("error-message").innerHTML = errorMessage;
    document.getElementById("error-message").style.display = "block";
  }

  return isValid;
}

// Form validation for task form
function validateTaskForm() {
  const title = document.getElementById("title").value;
  const dueDate = document.getElementById("due_date").value;

  let isValid = true;
  let errorMessage = "";

  // Reset error messages
  document.getElementById("error-message").innerHTML = "";

  // Validate title
  if (title.trim() === "") {
    errorMessage += "Task title is required.<br>";
    isValid = false;
  }

  // Validate due date
  if (dueDate.trim() === "") {
    errorMessage += "Due date is required.<br>";
    isValid = false;
  }

  // Display error message if validation fails
  if (!isValid) {
    document.getElementById("error-message").innerHTML = errorMessage;
    document.getElementById("error-message").style.display = "block";
  }

  return isValid;
}

// Confirm delete task
function confirmDelete(taskId) {
  if (confirm("Are you sure you want to delete this task?")) {
    window.location.href = "delete_task.php?id=" + taskId;
  }
}

// Initialize date pickers if they exist
document.addEventListener("DOMContentLoaded", function () {
  const dueDateInput = document.getElementById("due_date");
  if (dueDateInput) {
    // Set min date to today
    const today = new Date().toISOString().split("T")[0];
    dueDateInput.setAttribute("min", today);
  }
});
