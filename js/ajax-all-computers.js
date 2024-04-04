//Editar información 
function AdminComputersEdit(computerid) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SelectedComputerid=" + computerid);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.location.href = "change-computer-data";
		}
	}
}

function AdminDeleteComputer(computerid) {
	if (confirm("¿Está seguro que desea borrar la siguiente computadora y sus registros asociados? \n" + "Id: " + computerid)) {
		const XHR = new XMLHttpRequest();
		XHR.open('POST', 'controllers/ajax.php', true);
		XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		XHR.send("SelectedComputerid=" + computerid);
		XHR.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				window.location.href = "confirm-delete-computer";
			}
		}
	}
}
/*//Cuadro de Todos los usuarios Admin Enviar ID del Usuario
function AdminEditUser(userid) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SelectedUserid=" + userid);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.location.href = "change-user-data";
		}
	}
}

function AdminChangePasswordUser(userid) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SelectedUserid=" + userid);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.location.href = "change-user-password";
		}
	}
}

function AdminDeleteUser(userid) {
	if (confirm("¿Está seguro que desea borrar al siguiente usuario? \n" + "Id: " + userid)) {
		const XHR = new XMLHttpRequest();
		XHR.open('POST', 'controllers/ajax.php', true);
		XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		XHR.send("SelectedUserid=" + userid);
		XHR.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				window.location.href = "confirm-delete-user";
			}
		}
	}
}*/


//User- Computers - Search his/her computers

const SearchAllComputers = document.getElementById('SearchAllComputers');
SearchAllComputers.addEventListener('keyup', SearchAllComputersAjax);

function SearchAllComputersAjax() {
	var Consult = document.getElementById("SearchAllComputers").value;
	var contenedor = document.getElementById("resultados");
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SearchAllComputers=" + Consult);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var datos = this.responseText;
			contenedor.innerHTML = datos;
		}
	}
}


//Enviar a Imprimir la consulta
function printQuery2(consulta) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("ConsultaforprintingMyComputers2=" + consulta);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.open("PDF/all-computers-report-by-query");
		}
	}
}
