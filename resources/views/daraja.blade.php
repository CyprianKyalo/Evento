<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<title>Payment</title>
</head>
<body>

	<div class="row mt-5">
		<div class="col-sn-8 mx-auto">
			<div class="card">
				<div class="card-header">
					Obtain Access Token
				</div>
				
				<div class="card-body">
					<h4 id="access_token"></h4>
					<button class="btn btn-primary" id="getAccessToken">
						Request Access Token
					</button>
				</div>
			</div>

			<div class="card mt-5">
				<div class="card-header">
					Register URLs
				</div>
				<div class="card-body">
					<button id="registerURLS" class="btn btn-primary">
						Register URLs
					</button>
				</div>
			</div>

			<div class="card mt-5">
				<div class="card-header">
					Simulate Transactions
				</div>
				<div class="card-body">
					<form action="">
						{{csrf_field()}}
						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="number" class="form-control" name="amount" id="amount">
						</div>

						<div class="form-group">
							<label for="account">Account</label>
							<input type="text" class="form-control" name="account" id="account">
						</div>
						<button id="simulate" class="btn btn-primary">Simulate Payment</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="{{asset('js/app.js')}}"></script>
	<script>
		document.getElementById('getAccessToken').addEventListener('click', (event) => {
			event.preventDefault();

			axios.post('get-token', {})
			.then((response) => {
				console.log(response.data);
				document.getElementById('access_token').innerHTML = response.data.access_token
			})
			.catch((error) => {
				console.log(error);
			})
		});

		document.getElementById('simulate').addEventListener('click', (event) => {
			event.preventDefault();

			const requestBody = {
				amount: document.getElementById('amount').value,
				account: document.getElementById('account').value
			}

			axios.post('/simulate', requestBody)
			.then((response) => {
				console.log(response.data);
			})
			.catch((error) => {
				console.log(error);
			})
		});

		document.getElementById('registerURLS').addEventListener('click', (event) => {
			event.preventDefault();

			axios.post('register-urls', {})
			.then((response) => {
				console.log(response.data);
			})
			.catch((error) => {
				console.log(error);
			})
		});
	</script>

</body>
</html>