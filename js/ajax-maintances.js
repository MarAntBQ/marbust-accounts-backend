//Cuadro de Todos los usuarios Admin Enviar ID del Usuario
function AdminMaintanceInfo(maintanceId) {
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

function AdminMaintanceEdit(maintanceId) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SelectedUserMaintanceid=" + maintanceId);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.location.href = "edit-maintance-info";
		}
	}
}

function AdminMaintanceDelete(maintanceId) {
	if (confirm("¿Está seguro que desea borrar al siguiente mantenimiento? \n" + "Id: " + maintanceId)) {
		const XHR = new XMLHttpRequest();
		XHR.open('POST', 'controllers/ajax.php', true);
		XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		XHR.send("SelectedUserMaintanceid=" + maintanceId);
		XHR.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				window.location.href = "confirm-delete-maintance";
			}
		}
	}
}


//User- Computers - Search his/her computers

const SearchAllMaintances = document.getElementById('SearchAllMaintances');
SearchAllMaintances.addEventListener('keyup', SearchAllMaintancesAjax);

function SearchAllMaintancesAjax() {
	var Consult = document.getElementById("SearchAllMaintances").value;
	var contenedor = document.getElementById("resultados");
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SearchAllMaintances=" + Consult);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var datos = this.responseText;
			contenedor.innerHTML = datos;
		}
	}
}


//Enviar a Imprimir la consulta
function printQuery3(consulta) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("ConsultaforprintingAllMaintances=" + consulta);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.open("PDF/all-maintances-report-by-query");
		}
	}
}
