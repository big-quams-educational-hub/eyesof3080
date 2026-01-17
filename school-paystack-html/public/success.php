<!DOCTYPE html>
<html>
<body style="text-align:center;padding:50px;">
<h1>✅ Payment Successful</h1>
<p>Your payment has been confirmed.</p>
<a id="studentWA" href="#" target="_blank">Contact via WhatsApp</a>
<script>
const params = new URLSearchParams(window.location.search);
document.getElementById("studentWA").href = params.get("student");
</script>
</body>
</html>
