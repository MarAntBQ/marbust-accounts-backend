//Editar información 
function MyComputersEdit(computerid) {
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

const SearchBoxEachUserComputers = document.getElementById('SearchEachUserComputers');
SearchBoxEachUserComputers.addEventListener('keyup', SearchEachUserComputers);

function SearchEachUserComputers() {
	var Consult = document.getElementById("SearchEachUserComputers").value;
	var contenedor = document.getElementById("resultados");
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SearchEachUserComputers=" + Consult);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var datos = this.responseText;
			contenedor.innerHTML = datos;
		}
	}
}


//Enviar a Imprimir la consulta
function printQuery(consulta) {
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("ConsultaforprintingMyComputers=" + consulta);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			window.open("PDF/my-computers-report-by-query");
		}
	}
}
