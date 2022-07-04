<form>
  <script src="https://checkout.flutterwave.com/v3.js"></script>
  <button type="button" onClick="makePayment()">Pay Now</button>
</form>

<script>
  function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK_TEST-SANDBOXDEMOKEY-X",
      tx_ref: "RX1",
      amount: 10,
      currency: "KES",
      country: "KE",
      payment_options: "",
      redirect_url: // specified redirect URL
        "http://127.0.0.1/flutterwave/callback.php",
      meta: {
        consumer_id: 23,
        consumer_mac: "92a3-912ba-1192a",
      },
      customer: {
        email: "antony.m.munyao@gmail.com",
        phone_number: "+254706434259",
        name: "Antony Developer",
      },
      callback: function (data) {
        console.log(data);
      },
      onclose: function() {
        // close modal
      },
      customizations: {
        title: "Clouduka Checkout",
        description: "Payment for items in cart",
        logo: "https://clouduka.com/wp-content/uploads/2021/06/cloudukalogo3.png",
      },
    });
  }
</script>