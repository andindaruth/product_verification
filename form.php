<!DOCTYPE html>
<html>
<head>
    <title>Verify Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #D1FFBD;
            margin-left: 500px;
            margin-right: 500px;
            margin-top: 150px;
            font-size: 25px;
        }
    </style>
</head>
<body>
<div class="login-logo">
  <center><a href="#" class="text-success"><b>NASECO </b>Product verification</a></center>
</div>
<form id="verify-form">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter Code" id="code" name="code" required>
        <div class="row">
            <div class="col-6"></div>
            <button type="submit" class="btn btn-success btn-block"> Verify</button>
        </div>
    </div>
</form>
<div id="result"></div>

<script>
    document.getElementById('verify-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const code = document.getElementById('code').value;
        fetch('verify_code.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'code=' + code
        })
        .then(response => response.json())
        .then(data => {
            let resultMessage = '';
            if (data.status === 'valid') {
                resultMessage = 'Valid code. Product is genuine. Product ID: ' + data.product_id;
            } else if (data.status === 'used') {
                resultMessage = 'Code already used. Product might be counterfeit.';
            } else if (data.status === 'invalid') {
                resultMessage = 'Invalid code. Product might be counterfeit.';
            } else {
                resultMessage = 'Error: ' + data.error;
            }
            document.getElementById('result').innerText = resultMessage;
        });
    });
</script>
</body>
</html>
