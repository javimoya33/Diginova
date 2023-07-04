<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield("titulo")</title>
  @include('base_includes')
</head>

<body>
<div class="wrapper" name="appx" id="appx">



	<h6>
		<form method="post" action="" id="horario">
			<input name="elhorario" id="datetimepicker" type="text"
				style="margin-top: 10px; width: auto;"
				class="form-control input-normal" 
				value=""  readonly="readonly"
				placeholder="Seleccione un horario"
				onchange="" />
		</form>
	</h6>
	<script>
		$('#datetimepicker').datetimepicker({
			dayOfWeekStart : 1,
			lang:'es',
			format:'d/m/Y H:i',
			onClose:function(ct,$input){
				//alert("park");
				return;
		}
		});
	</script>



</div>
</body>
</html>
