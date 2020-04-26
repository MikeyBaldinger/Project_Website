var wantedText = document.getElementById("input");
var profitElement = document.getElementById("profit");
var profitTextElement = document.getElementById("profitText");

function updateText() {
  var profit = ((wantedText.value));
  profitElement.value = profit;
  profitTextElement.innerText = profit;
}

wantedText.onchange = updateText;
