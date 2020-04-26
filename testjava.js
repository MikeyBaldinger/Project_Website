var openElement = document.getElementById("openamount");
var closeElement = document.getElementById("closeamount");
var profitElement = document.getElementById("profit");
var profitTextElement = document.getElementById("profitText");

function updateProfit() {
  var profit = ((closeElement.value));
  profitElement.value = profit;
  profitTextElement.innerText = profit;
}

openElement.onchange = closeElement.onchange = updateProfit;
