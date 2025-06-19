let result = document.querySelector(".result h1");
function calculate(op) {
  let firstNum = document.getElementById("firstnumber");
  let lastNum = document.getElementById("lastnumber");
  event.preventDefault();
  let FinaleResult;
  if (op === "-") {
    FinaleResult = firstNum.value - lastNum.value;
  } else if (op === "/") {
    FinaleResult = firstNum.value / lastNum.value;
  } else {
    FinaleResult = (parseFloat(firstNum.value) + parseFloat(lastNum.value)) / 2;
  }
  result.textContent = "Result: " + FinaleResult;
}