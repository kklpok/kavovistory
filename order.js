const orderForm = document.getElementById('orderForm');
const orderDetails = document.getElementById('orderDetails');

orderForm.addEventListener('submit', function(event) {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const product = document.getElementById('product').value;
  const quantity = parseInt(document.getElementById('quantity').value);

  const prices = {
    coffee: 30,
    dessert: 20,
    pastry: 15
  };

  const totalPrice = prices[product] * quantity;

  orderDetails.innerHTML = `
    <p>Замовлення для: ${name}</p>
    <p>Email: ${email}</p>
    <p>Товар: ${product}</p>
    <p>Кількість: ${quantity}</p>
    <p>Загальна вартість: ${totalPrice} грн</p>
  `;
});
