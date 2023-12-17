const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");
const addMoreBtn = document.querySelector(".Addmore");
const btnNext = document.querySelector(".btn-next");
const btnPrev = document.querySelector(".btn-prev");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (formStepsNum < formSteps.length - 1) {
      formStepsNum++;
      updateFormSteps();
      updateProgressbar();
    }
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (formStepsNum > 0) {
      formStepsNum--;
      updateFormSteps();
      updateProgressbar();
    }
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep, idx) => {
    if (idx === formStepsNum) {
      formStep.classList.add("form-step-active");
    } else {
      formStep.classList.remove("form-step-active");
    }
  });
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

let i = 0;
addMoreBtn.addEventListener("click", (e) => {
  e.preventDefault();

  i++;

  // create table row
  const tr = document.createElement("tr");
  const td1 = document.createElement("td");
  const td2 = document.createElement("td");

  // create select element
  const selectElement = document.createElement("select");
  selectElement.name = "addmore[" + i + "][service]";
  selectElement.className = "service form-control";

  // add default option
  const defaultOption = document.createElement("option");
  defaultOption.value = "";
  defaultOption.textContent = "Select a service";
  selectElement.appendChild(defaultOption);

  // add options from server-side data
  serviceOptions.forEach((option) => {
    const optionElement = document.createElement("option");
    optionElement.value = option.id;
    optionElement.textContent = option.name;
    selectElement.appendChild(optionElement);
  });

  // create input field
  const inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.name = "addmore[" + i + "][qty]";
  inputElement.placeholder = "Enter your Qty";
  inputElement.className = "form-control";

  td1.appendChild(selectElement);
  td2.appendChild(inputElement);

  tr.appendChild(td1);
  tr.appendChild(td2);

  // append the table row to the table
  const table = document.querySelector("#FormItems table");
  table.appendChild(tr);
});

btnNext.addEventListener("click", (e) => {
  e.preventDefault();
  const currentStep = document.querySelector(".form-step-active");
  const nextStep = currentStep.nextElementSibling;

  currentStep.classList.remove("form-step-active");
  nextStep.classList.add("form-step-active");
});

btnPrev.addEventListener("click", (e) => {
  e.preventDefault();
  const currentStep = document.querySelector(".form-step-active");
  const prevStep = currentStep.previousElementSibling;

  currentStep.classList.remove("form-step-active");
  prevStep.classList.add("form-step-active");
});
