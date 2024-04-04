//Cuadro de Todos los usuarios Admin Enviar ID del Usuario
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
}

//Admin - Search Users

const SearchBox = document.getElementById('SearchUser');
SearchBox.addEventListener('keyup', SearchUsers);

function SearchUsers() {
	var Consult = document.getElementById("SearchUser").value;
	var contenedor = document.getElementById("resultados");
	const XHR = new XMLHttpRequest();
	XHR.open('POST', 'controllers/ajax.php', true);
	XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	XHR.send("SearchUser=" + Consult);
	XHR.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var datos = this.responseText;
			contenedor.innerHTML = datos;
		}
	}
}