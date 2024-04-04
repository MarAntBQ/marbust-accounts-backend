//Cuadro de Todos los usuarios Admin Enviar ID del Usuario
function UserMaintanceInfo(maintanceId) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SelectedUserMaintanceid=" + maintanceId);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.open("PDF/maintance-report");
		}
	}
}
/*
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

const SearchMyMaintances = document.getElementById('SearchMyMaintances');
SearchMyMaintances.addEventListener('keyup', SearchMyMaintancesAjax);

function SearchMyMaintancesAjax() {
	var Consult = document.getElementById("SearchMyMaintances").value;
	var contenedor = document.getElementById("resultados");
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SearchMyMaintances=" + Consult);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var datos = this.responseText;
			contenedor.innerHTML = datos;
		}
	}
}


//Enviar a Imprimir la consulta
function printQuery4(consulta) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("ConsultaforprintingMyMaintances=" + consulta);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.open("PDF/my-maintances-report-by-query");
		}
	}
}
