// Sample product data (replace with your actual data)
const products = [
  { name: "Еспресо", price: 25 },
  { name: "Американо", price: 30 },
  { name: "Капучіно", price: 35 },
  { name: "Латте", price: 40 },
  { name: "Мокко", price: 45 },
];

// Function to display the product list
function displayProductList() {
  let productList = "";
  for (const product of products) {
    productList += `${product.name}: ${product.price} грн\n`;
  }
  alert(`Список товарів/послуг:\n${productList}`);
}

// Function to handle order placement
function placeOrder() {
  let productName = prompt("Введіть назву товару:");
  let quantity = parseInt(prompt("Введіть кількість:"));

  if (!productName || isNaN(quantity) || quantity <= 0) {
    alert("Неправильні дані. Спробуйте ще раз.");
    return;
  }

  const product = products.find((product) => product.name.toLowerCase() === productName.toLowerCase());
  if (!product) {
    alert("Такого товару немає.");
    return;
  }

  const totalCost = product.price * quantity;
  alert(`Ваше замовлення:\n${productName} x ${quantity} = ${totalCost} грн`);
}

// Add a "Замовлення" button to the "Товари/Послуги" page
const orderButton = document.createElement("button");
orderButton.textContent = "Замовлення";
orderButton.addEventListener("click", placeOrder);

document.body.appendChild(orderButton);
