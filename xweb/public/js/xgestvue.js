var app = new Vue({
	delimiters: ['{!', '!}'],
	el: '#appx',
	data: {
		imagesxxxxxxxxxxxxx: [],
		usuario: "",
		password: "",
		// formulario registro
		rotar: false,
		nombreUsuario: "",
		clave0: "",
		clave1: "",
		clave2: "",
		nombreCliente: "",
		dni: "",
		direccion: "",
		poblacion: "",
		codigoPostal: "",
		cpostal: "",
		provincia: 0,
		eMail: "",
		telefono: "",
		cCha: "",
		observaciones: "",
		consulta: "",
		boletin: false,
		rma_recogida: false,
		rma_recnombre: "",
		rma_reccalle: "",
		rma_recpoblacion: "",
		rma_recprovincia: "",
		rma_recpostal: "",
		rma_rectelefono: "",
		rma_rechorario: "",
		rma_anotaciones: "",
		rma_imagen1: "",
		rma_imagen2: "",
		rma_imagen3: "",
		rma_imagen4: "",
		rma_imagen5: "",
		rma_addproduct: "",
		rma_addproduct_des: "",
		rma_addproduct_solicita: "",
		rma_addproduct_cantidad: 1,
		rma_bultos: 1,
		rma_cajabusqueda: false,
		rma_json: null,
		rma_articulos: [],
		cName: "coni", // formulario contacto
		busqueda: "",
		resultadobus: false,
		timeout: null,
		timeout2: null,
		ruta: "",
		rutaimg: "",
		buscando: false,
		//
	},
	methods: {
		procesosSecundarios: function () {
			clearTimeout(this.timeout);
			this.timeout = setTimeout(function () {
				$
					.ajax({
						url: 'procesosSecundarios',
						data: {
							_token: $('meta[name="csrf-token"]').attr('content'),
						},
						type: 'POST',
						async: true,
						success: function (result) {
							//alert(result);
						}
					});
			}.bind(this), 5);
		},
		abuscar_reset: function (xx) {
			this.resultadobus = false;
			this.busqueda = "";
			this.$refs.abuscar.focus();
		},
		abuscar: function (ruta, rutaimg) {
			this.ruta = ruta;
			this.rutaimg = rutaimg;
			var x = (this.busqueda);
			if (x.length < 3) {
				this.resultadobus = false;
				return;
			}
			clearTimeout(this.timeout);
			// Make a new timeout set to go off in 800ms
			this.timeout = setTimeout(function () {
				var self = this;
				this.buscando = true;
				$
					.ajax({
						url: 'buscarVue',
						data: {
							_token: $('meta[name="csrf-token"]').attr('content'),
							texto: x,
						},
						type: 'POST',
						async: true,
						success: function (result) {
							self.resultadobus = (result);
							self.buscando = false;
						}
					});
			}.bind(this), 500);
			this.buscando = false;
		},
		/*
		abuscar: async function (ruta,rutaimg) {
			this.ruta=ruta;
			this.rutaimg=rutaimg;
			var x=(this.busqueda);
			if(x.length<3){
				this.resultadobus=false;
				return;
			}
			clearTimeout(this.timeout);
			// Make a new timeout set to go off in 800ms
			this.timeout = setTimeout(async() => {
				try {
					this.buscando=true;
					var response = await axios.post("buscarVue", {
						_token: $('meta[name="csrf-token"]').attr('content'),
						texto: x,
					}, {
						headers: {'X-Requested-With': 'XMLHttpRequest'},
					});
					this.buscando=false;
					this.resultadobus=(response.data);
				} catch (e) {
					alertify.alert('', 'error al buscar, ' + e);
					return false;
				}
			}, 500);
			this.buscando=false;
		},
		*/
		onFileChanged: function (event) {
			const file = event.target.files[0];
			//alert(file);
			alertify.alert('', file);
		},
		onUpload: function () {
			axios.post('my-domain.com/file-upload', this.selectedFile);
			//alert(this.selectedFile);
			alertify.alert('', this.selectedFile);
		},
		rma_alta: function (ruta) {
			if (this.rma_articulos.length == 0) {
				//alert("no se añadieron artículos");
				alertify.alert('', "no se añadieron artículos");
				return false;
			}
			//alert(ruta);
			var datos = {
				_token: $('meta[name="csrf-token"]').attr('content'),
				rma_recogida: this.rma_recogida,
				rma_recnombre: this.rma_recnombre,
				rma_reccalle: this.rma_reccalle,
				rma_recpoblacion: this.rma_recpoblacion,
				rma_recprovincia: this.rma_recprovincia,
				rma_recpostal: this.rma_recpostal,
				rma_rectelefono: this.rma_rectelefono,
				rma_rechorario: this.rma_rechorario,
				rma_anotaciones: this.rma_anotaciones,
				//rma_imagen1:this.rma_imagen1,
				//rma_imagen2:this.rma_imagen2,
				//rma_imagen3:this.rma_imagen3,
				//rma_imagen4:this.rma_imagen4,
				//rma_imagen5:this.rma_imagen5,
				rma_articulos: this.rma_articulos,
			};
			$.ajax({
				url: ruta,
				data: {
					_token: $('meta[name="csrf-token"]').attr('content'),
					rma_recogida: this.rma_recogida,
					rma_recnombre: this.rma_recnombre,
					rma_reccalle: this.rma_reccalle,
					rma_recpoblacion: this.rma_recpoblacion,
					rma_recprovincia: this.rma_recprovincia,
					rma_recpostal: this.rma_recpostal,
					rma_rectelefono: this.rma_rectelefono,
					rma_rechorario: this.rma_rechorario,
					rma_anotaciones: this.rma_anotaciones,
					rma_bultos: this.rma_bultos,
					//rma_imagen1:this.rma_imagen1,
					//rma_imagen2:this.rma_imagen2,
					//rma_imagen3:this.rma_imagen3,
					//rma_imagen4:this.rma_imagen4,
					//rma_imagen5:this.rma_imagen5,
					rma_articulos: this.rma_articulos,
				},
				type: 'POST',
				async: false,
				success: function (result) {
					switch (result.exito) {
						case true:
							window.location.href = result.ruta;
							//alert(result.ruta);
							break;
						case false:
							//alert("Hubo un error en el envío de mail, pero el documento se realizó con éxito.");
							alertify.alert('', "Hubo un error en el envío de mail, pero el documento se realizó con éxito.");
							window.location.href = result.ruta;
							break;
					}
				}
			});
		},
		rma_handleFileUpload: function (ruta, pos) {
			switch (pos) {
				case 1:
					this.file = this.$refs.file1.files[0];
					break;
				case 2:
					this.file = this.$refs.file2.files[0];
					break;
				case 3:
					this.file = this.$refs.file3.files[0];
					break;
				case 4:
					this.file = this.$refs.file4.files[0];
					break;
				case 5:
					this.file = this.$refs.file5.files[0];
					break;
			}
			let formData = new FormData();
			formData.append('file', this.file);
			axios.post(ruta,
					formData, {
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
				).then(function () {
					console.log('SUCCESS!!');
				})
				.catch(function () {
					console.log('FAILURE!!');
				});
		},
		rma_seleccionarproducto: function (cod) {
			this.rma_addproduct = cod.acodar;
			this.rma_addproduct_des = cod.adescr;
			this.rma_cajabusqueda = false;
		},
		rma_buscarproducto: function (ruta) {
			if (this.rma_addproduct.trim().length == 0) {
				this.rma_cajabusqueda = false;
				return false;
			}
			this.$http.get(ruta + '/' + this.rma_addproduct, 'data').then(function (response) {
				//Método que se dispara cuando vuelve la respuesta del servidor.
				this.rma_cajabusqueda = true;
				//alert(response.body.respuesta);
				//$("ul#results").html(response.body.respuesta);
				var json = response.body.respuesta;
				this.rma_json = json;
				//console.log(json);
				//$("ul#results").html(json);
				//$("ul#results").html("response.body.respuesta");
			}, function () {
				//Método que se dispara si hubo algún error.
				//alert("fallo ajax");
				this.rma_cajabusqueda = false;
				return false;
			});
		},
		rma_deleterow: function (objeto, codigo) {

			$('#rmagrid').dataTable().fnDeleteRow($(objeto).parents('tr'));
			var i;
			for (i = 0; i < this.rma_articulos.length; i++) {
				if (this.rma_articulos[i].acodar == codigo) {
					this.rma_articulos.splice(i, 1);
					console.log("borra " + codigo);
					break;
				}
			}
			//const item=this.rma_articulos.find(item=>item.acodar===codigo);
			//this.rma_articulos.splice(this.rma_articulos.indexOf(item),1);
		},
		rma_addrow: function () {
			if (this.rma_addproduct.trim().length == 0) {
				//alert("falta código de producto");
				alertify.alert('', "falta código de producto");
				return false;
			}
			if (this.rma_addproduct_des.trim().length == 0) {
				//alert("seleccione el producto del listado en la parte inferior");
				alertify.alert('', "seleccione el producto del listado en la parte inferior");
				return false;
			}
			if (this.rma_addproduct_solicita.trim().length < 5) {
				//alert("falta tipo de solicitud");
				alertify.alert('', "falta tipo de solicitud");
				return false;
			}
			if (this.rma_addproduct_cantidad <= 0) {
				//alert("falta cantidad");
				alertify.alert('', "falta cantidad");
				return false;
			}

			var rowId = $("#rmagrid >tbody >tr").length - 1;
			rowId++;
			$('#rmagrid').dataTable().fnAddData([
				this.rma_addproduct,
				this.rma_addproduct_des,
				this.rma_addproduct_solicita,
				this.rma_addproduct_cantidad,
				"<button class=\"btn btn-danger\" onclick=\"app.rma_deleterow(this,'" + this.rma_addproduct.trim() + "')\"><span class=\"glyphicon glyphicon-remove\"></span></button>"
			]);
			var cuenta = this.rma_articulos.length;
			this.rma_articulos.push({
				'acodar': this.rma_addproduct,
				'adescr': this.rma_addproduct_des,
				'cantidad': this.rma_addproduct_cantidad,
				'solicita': this.rma_addproduct_solicita
			});
			this.rma_addproduct = "";
			this.rma_addproduct_des = "";
			this.rma_addproduct_solicita = "";
			this.rma_addproduct_cantidad = 1;
			this.rma_cajabusqueda = false;
		},
		recordarclave: function (ruta) {
			if (this.usuario.length == 0) {
				//alert("Introduzca su nombre de usuario ó dirección de correo para continuar.");
				alertify.alert('', "Introduzca su nombre de usuario ó dirección de correo para continuar.");
				return;
			}
			ruta += "/recordarclave";
			$
				.ajax({
					url: ruta,
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						usuario: this.usuario,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						alertify.alert('', result.respuesta);
					}
				});
			/*
			try {
				var response = await axios.post(ruta, {
					_token: $('meta[name="csrf-token"]').attr('content'),
					usuario: this.usuario,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				alertify.alert('', response.data.respuesta);
			} catch (e) {
				alertify.alert('', 'error al solicitar recurso, ' + e);
				return false;
			}
			*/
			return true;
		},
		contacto: function () {
			//this.nombreCliente="cliente de pruebas";
			//this.eMail="josejavier@xgestevo.net";
			//this.telefono="666555444";
			//this.consulta = "josejavier@xgestevo.net";
			//var postData = $("#formContacto").serialize();
			var self = this;
			this.rotar = false;
			if (this.nombreCliente.length < 6 || this.eMail.length < 3 || this.consulta.length < 3) {
				//alert("Rellene todos los campos.");
				alertify.alert('', "Rellene todos los campos.");
				return false;
			}
			this.rotar = true;
			$
				.ajax({
					url: "contactar",
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						cName: this.nombreCliente,
						cMail: this.eMail,
						cTel: this.telefono,
						cConsulta: this.consulta,
						cCha: 'x'+this.cCha
					},
					type: 'POST',
					async: false,
					success: function (result) {
						switch (result.exito) {
							case true:
								self.rotar = false;
								alertify.alert('', result.errors).set('modal', true);
								self.nombreCliente = "";
								self.eMail = "";
								self.telefono = "";
								self.consulta = "";
								break;
							case false:
								//alert(result.errors);
								self.rotar = false;
								alertify.alert('', result.errors);
								break;
						}
					}
				});
			this.rotar = false;

			/*
			try {
				var response = await axios.post("contactar", {
					_token: $('meta[name="csrf-token"]').attr('content'),
					cName: this.nombreCliente,
					cMail: this.eMail,
					cTel: this.telefono,
					cConsulta: this.consulta,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				switch (response.data.exito) {
					case true:
						this.rotar = false;
						alertify.alert('', response.data.errors).set('modal', true);
						this.nombreCliente = "";
						this.eMail = "";
						this.telefono = "";
						this.consulta = "";
						break;
					case false:
						//alert(result.errors);
						this.rotar = false;
						alertify.alert('', response.data.errors);
						break;
				}
			} catch (e) {
				alertify.alert('', 'error al enviar contacto, ' + e);
				return false;
			}
			*/
		},
		registro: function () {
			//this.nombreUsuario="pru @ ebas";
			//this.nombreCliente="cliente de pruebas";
			//this.clave1="123456";this.clave2="123456";
			//this.eMail="josejavier@xgestevo.net";
			//this.dni="23017849r";
			//var postData = $("#formRegistro").serialize();
			//alert(postData);
			if (this.nombreUsuario.length < 6) {
				//alert("Complete el campo Nombre de usuario");
				alertify.alert('', "Complete el campo Nombre de usuario. El campo debe tener un mínimo de 6 caracteres.");
				return false;
			}
			if (this.nombreCliente.length < 6) {
				//alert("Complete el campo Nombre y apellidos");
				alertify.alert('', "Complete el campo Nombre y apellidos. El campo debe tener un mínimo de 6 caracteres.");
				return false;
			}
			if (this.dni.length < 9) {
				//alert("Complete el campo NIF/CIF");
				alertify.alert('', "Complete el campo NIF/CIF. El campo debe tener un mínimo de 9 caracteres.");
				return false;
			}
			if (this.clave1.length < 9 || this.clave2.length < 9) {
				//alert("Complete el campo Clave de acceso");
				alertify.alert('', "Complete el campo Clave de acceso. El campo debe tener un mínimo de 9 caracteres.");
				return false;
			}
			if (this.clave1 != this.clave2) {
				//alert("Complete el campo Clave de acceso");
				alertify.alert('', "Las contraseñas no coinciden.");
				return false;
			}
			if (this.direccion.length < 9) {
				alertify.alert('', "Complete el campo Dirección. El campo debe tener un mínimo de 9 caracteres.");
				return false;
			}
			if (this.poblacion.length < 3) {
				alertify.alert('', "Complete el campo Población. El campo debe tener un mínimo de 3 caracteres.");
				return false;
			}
			if (this.codigoPostal.length < 5) {
				alertify.alert('', "Complete el campo Código Postal. El campo debe tener un mínimo de 5 caracteres.");
				return false;
			}
			if (this.telefono.length < 9) {
				alertify.alert('', "Complete el campo Teléfono. El campo debe tener un mínimo de 9 caracteres.");
				return false;
			}
			this.rotar = true;
			var self = this;
			$
				.ajax({
					url: "completarRegistro",
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						nombreUsuario: this.nombreUsuario,
						clave1: this.clave1,
						clave2: this.clave2,
						nombreCliente: this.nombreCliente,
						eMail: this.eMail,
						dni: this.dni,
						direccion: this.direccion,
						poblacion: this.poblacion,
						codigoPostal: this.codigoPostal,
						provincia: this.provincia,
						telefono: this.telefono,
						observaciones: this.observaciones,
						boletin: this.boletin,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						switch (result.exito) {
							case true:
								//alert(result.errors);
								self.rotar = false;
								//alertify.alert('', response.data.errors);
								window.location.href = result.destino;
								break;
							case false:
								//alert(result.errors);
								self.rotar = false;
								alertify.alert('', result.errors);
								break;
						}
					}
				});
			/*
			try {
				var response = await axios.post("completarRegistro", {
					_token: $('meta[name="csrf-token"]').attr('content'),
					nombreUsuario: this.nombreUsuario,
					clave1: this.clave1,
					clave2: this.clave2,
					nombreCliente: this.nombreCliente,
					eMail: this.eMail,
					dni: this.dni,
					direccion: this.direccion,
					poblacion: this.poblacion,
					codigoPostal: this.codigoPostal,
					provincia: this.provincia,
					telefono: this.telefono,
					observaciones: this.observaciones,
					boletin: this.boletin,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				switch (response.data.exito) {
					case true:
						//alert(result.errors);
						this.rotar = false;
						//alertify.alert('', response.data.errors);
						window.location.href = response.data.destino;
						break;
					case false:
						//alert(result.errors);
						this.rotar = false;
						alertify.alert('', response.data.errors);
						break;
				}
			} catch (e) {
				alertify.alert('', 'error al registrar, ' + e);
				return false;
			}
			*/
		},
		registro_actualizar: function () {
			//var postData = $("#formRegistro").serialize();
			if (this.nombreUsuario.length < 3) {
				//alert("Complete el campo Nombre de usuario");
				alertify.alert('', "Complete el campo Nombre de usuario");
				return false;
			}
			if (this.clave0.length < 1) {
				//alert("Complete el campo Clave de acceso actual");
				alertify.alert('', "Complete el campo Clave de acceso actual");
				return false;
			}
			if (this.clave1 != this.clave2) {
				//alert("No coinciden los datos de nueva clave");
				alertify.alert('', "No coinciden los datos de nueva clave");
				return false;
			}
			/*if (this.nombreCliente.length < 15) {
				//alert("Complete el campo Nombre y apellidos");
				alertify.alert('', "Complete el campo Nombre y apellidos");
				return false;
			}
			if (this.dni.length < 5) {
				//alert("Complete el campo NIF/CIF");
				alertify.alert('', "Complete el campo NIF/CIF");
				return false;
			}
			if (this.eMail.length < 5) {
				//alert("Complete el campo Dirección de mail");
				alertify.alert('', "Complete el campo Dirección de mail");
				return false;
			}*/
			this.rotar = true;
			var self = this;
			$
				.ajax({
					url: "../modificarRegistro",
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						nombreUsuario: this.nombreUsuario,
						clave0: this.clave0,
						clave1: this.clave1,
						clave2: this.clave2,
						nombreCliente: this.nombreCliente,
						dni: this.dni,
						direccion: this.direccion,
						poblacion: this.poblacion,
						codigoPostal: this.codigoPostal,
						provincia: this.provincia,
						eMail: this.eMail,
						telefono: this.telefono,
						boletin: this.boletin,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						switch (result.exito) {
							case true:
								//alert(result.errors);
								self.rotar = false;
								alertify.alert('', result.errors);
								//window.location.href = response.data.destino;
								break;
							case false:
								//alert(result.errors);
								self.rotar = false;
								alertify.alert('', result.errors);
								break;
						}
					}
				});
			/*
			try {
				var response = await axios.post("../modificarRegistro", {
					_token: $('meta[name="csrf-token"]').attr('content'),
					nombreUsuario: this.nombreUsuario,
					clave0: this.clave0,
					clave1: this.clave1,
					clave2: this.clave2,
					nombreCliente: this.nombreCliente,
					dni: this.dni,
					direccion: this.direccion,
					poblacion: this.poblacion,
					codigoPostal: this.codigoPostal,
					provincia: this.provincia,
					eMail: this.eMail,
					telefono: this.telefono,
					boletin: this.boletin,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				switch (response.data.exito) {
					case true:
						//alert(result.errors);
						this.rotar = false;
						alertify.alert('', response.data.errors);
						//window.location.href = response.data.destino;
						break;
					case false:
						//alert(result.errors);
						this.rotar = false;
						alertify.alert('', response.data.errors);
						break;
				}
			} catch (e) {
				alertify.alert('', 'error al modificar registro, ' + e);
				return false;
			}
			*/
		},
		iniciosesion: function (ruta) {
			if (this.usuario.length < 1 || this.password.length < 1) {
				alertify.alert('', "Complete usuario y clave");
				return false;
			}
			//var postData = $("#iniciosesion").serialize();
			var self = this;
			$
				.ajax({
					url: ruta,
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						usuario: this.usuario,
						password: this.password,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						switch (result.exito) {
							case true:
								window.location.reload();
								break;
							case false:
								alertify.alert('', "Datos de inicio de sesión erróneos.");
								break;
						}
					}
				});
			/*
			try {
				var response = await axios.post(ruta, {
					_token: $('meta[name="csrf-token"]').attr('content'),
					usuario: this.usuario,
					password: this.password,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				switch (response.data.exito) {
					case true:
						window.location.reload();
						break;
					case false:
						alertify.alert('', "Datos de inicio de sesión erróneos.");
						break;
				}
			} catch (e) {
				alertify.alert('', 'error en el proceso de inicio de sesión, ' + e);
				return false;
			}
			*/
			return false;
		},
		iniciosesionGlobal: function (ruta, cliente, clave, raiz) {
			$
				.ajax({
					url: ruta,
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						usuario: cliente,
						password: clave,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						switch (result.exito) {
							case true:
								window.location.href = raiz;
								//window.location.reload();
								break;
							case false:
								alert("Datos de inicio de sesión erróneos.");
								alertify.alert('', "Datos de inicio de sesión erróneos.");
								break;
						}
					}
				});
			/*
			try {
				var response = await axios.post(ruta, {
					_token: $('meta[name="csrf-token"]').attr('content'),
					usuario: cliente,
					password: clave,
				}, {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
				});
				switch (response.data.exito) {
					case true:
						window.location.href = raiz;
						//window.location.reload();
						break;
					case false:
						alert("Datos de inicio de sesión erróneos.");
						alertify.alert('', "Datos de inicio de sesión erróneos.");
						break;
				}
			} catch (e) {
				alert('error en el proceso de inicio de sesión, ' + e);
				alertify.alert('', 'error en el proceso de inicio de sesión, ' + e);
				return false;
			}
			*/
			return false;
		},
		vueTeclaIntro: function (objeto, etiqueta) {
			if (event.keyCode == '13') {
				if (etiqueta.length == 0) {
					eval("this.$refs." + objeto + ".blur()");
				} else {
					eval("this.$refs." + etiqueta + ".blur()");
				}
			}
			return true;
		},
		vueBuscarArticulo: function (query_value) {
			if (query_value == '' || query_value.length == 0) {
				return false;
			}
			this.$http.get('buscarArticuloDescripcion', {
				params: {
					bus: query_value
				}
			}).then(function (response) {
				var html = response.body;
				this.resbusqueda = html;
				if (html.length > 0) {
					this.resuldiv = true;
					return true;
				}
			}, function () {
				return false;
			});
		},
		vueTeclaIntroFocusOn: function (el) {
			if (event.keyCode == '13') {
				$("#" + el).focus();
			}
			return true;
		},
		mensaje: function (el) {
			console.log(el);
		},
		confirmacion: function (texto) {
			return confirm(texto);
		},
		cambiarOrden: function (ruta) {
			$
				.ajax({
					url: ruta,
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
					},
					type: 'GET',
					async: false,
					success: function (result) {
						window.location.reload();
					}
				});
			/*
			axios.get(ruta).then(function (x) {
				//console.log(x);
				//alert('x');
				window.location.reload();
			})
			.catch(function (x) {
				//console.log(x);
				//alert('y');
			});
			*/
			return true;
		},
		eliminardireccion: function (iddir,ruta) {
			$
				.ajax({
					url: ruta+"/deletedireccionenvio/"+iddir,
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
						id:iddir,
					},
					type: 'POST',
					async: false,
					success: function (result) {
						//alertify.alert('', result.respuesta);
					}
				});
			window.location.href = ruta+"/micuenta/datos";
		},
		test: function () {
			alert("test");
		},
	},
	mounted: function () {
		// carga de imagenes tras la carga completa de la pagina
		lazyLoadInstance = new LazyLoad({
			elements_selector: ".lazy"
			// ... more custom settings?
		});
	}
});