const form = document.getElementsByTagName("form")[0];
const patternColombia = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.co)+$/;

const email = document.getElementById("mail");
const emailError = document.querySelector("#error");

const checkbox = document.getElementById("checkbox");
const checkboxError = document.querySelector("#checkbox + span.error");

const button = document.getElementById("submit-btn");
const arrow = document.getElementById("ic-arrow");

function buttonClick() {
  // In case there is an error message visible, if the field
  // is valid, remove the error message.
  emailError.textContent = ""; // Reset the content of the message
  emailError.className = "error"; // Reset the visual state of the message
  arrow.className = "ic-arrow";
  button.disabled = false; // Enable button
  button.style.cursor = "pointer";
}

email.addEventListener("input", function (event) {
  // Each time the user types something, we check if the
  // form fields are valid.

  if (
    email.validity.valid ||
    !patternColombia.test(email.value) ||
    !button.checked
  ) {
    // In case there is an error message visible, if the field
    // is valid, remove the error message.
    emailError.textContent = ""; // Reset the content of the message
    emailError.className = "error"; // Reset the visual state of the message
    arrow.className = "ic-arrow";
    button.disabled = false; // Enable button
    button.style.cursor = "pointer"; // Make button clickable
  } else {
    // If there is still an error, show the correct error
    showError();
  }
});

form.addEventListener("submit", function (event) {
  // if the email field is valid, we let the form submit

  if (
    !checkbox.checked ||
    !email.validity.valid ||
    patternColombia.test(email.value)
  ) {
    // If it isn't, we display an appropriate error message
    showError();
    // Then we prevent the form from being sent by canceling the event
    event.preventDefault();
  }
});

function showError() {
  button.disabled = true; // Disable button
  button.style.cursor = "unset"; // Make button not clickable
  if (email.validity.valueMissing) {
    // If the field is empty,
    // display the following error message.
    emailError.textContent = "Email address is required.";
  } else if (email.validity.typeMismatch) {
    // If the field doesn't contain an email address,
    // display the following error message.
    emailError.textContent = "Please provide a valid e-mail address.";
  } else if (!checkbox.checked) {
    // If the checkbox isn't checked,
    // display the following error message.
    emailError.textContent = `You must accept the terms and conditions`;
  } else if (patternColombia.test(email.value)) {
    // If the email is from Colombia,
    // display the following error message.
    emailError.textContent = `We are not accepting subscriptions from Colombia
    emails`;
  }

  // Set the styling appropriately
  emailError.className = "error active";
  arrow.className = "ic-arrow disabled";
}
