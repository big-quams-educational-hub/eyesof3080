<?php require "../app/Helpers/Env.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>School Fees Payment</title>
<link rel="stylesheet" href="assets/style.css">
<script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>

<h2>Pay School Fees</h2>

<form>
<input placeholder="Name" id="name" required>
<input placeholder="Email" id="email" type="email" required>
<input placeholder="Phone" id="phone" required>
<select id="service">
    <option value="School Fees">School Fees</option>
    <option value="Acceptance Fee">Acceptance Fee</option>
    <option value="Online Coaching">Online Coaching</option>
</select>
<input placeholder="Amount (₦)" id="amount" type="number" required>
<button type="button" onclick="pay()">Pay Now</button>
</form>

<script>
function pay(){
    let handler = PaystackPop.setup({
        key: "<?= getenv('PAYSTACK_PUBLIC_KEY') ?>",
        email: document.getElementById("email").value,
        amount: document.getElementById("amount").value * 100,
        currency: "NGN",
        ref: 'SCH_' + Math.floor(Math.random() * 1000000000),
        callback: function(r){
            location.href = "../verify.php?ref="+r.reference
                +"&name="+document.getElementById("name").value
                +"&email="+document.getElementById("email").value
                +"&phone="+document.getElementById("phone").value
                +"&service="+document.getElementById("service").value
                +"&amount="+document.getElementById("amount").value;
        },
        onClose: function(){
            alert('Transaction cancelled');
        }
    });
    handler.openIframe();
}
</script>

</body>
</html>
