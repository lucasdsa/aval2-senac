$(document).ready(function () {
    
    $('#add').click(function () {
        
        window.location = 'environment.php?view=add';
    });
	
	$('.edit').click(function () {
	
	    var email = findEmail($(this)[0]);
		var url = 'edit.php?email=' + email[0];
		
		window.location = url;
	});
    
   
    $('#submitedit').click(function (event) {
        
        event.preventDefault();
        makeRequest('Informações atualizadas!', 'Falha ao editar usuário!', 'edit.php');
    });
    
    $('#submitadd').click(function (event) {
        
        event.preventDefault();
        makeRequest('Usuário criado!', 'Falha ao criar usuário!', 'add.php');
    });
    
    var removeButtons = document.getElementsByClassName('remove');
    
    for (var i = 0; i < removeButtons.length; i++) {
        
        var button = removeButtons[i];
        button.addEventListener('click', createFunction(button));
    }
    
});

function createFunction(button) {
    
    return function () {
        
        if (confirm('Deseja remover o usuário?')) {
            
            var tr = button.parentNode.parentNode.childNodes;
            var data = findEmail(button);
			removeUserRequest(data[0], data[1]);
        }
    }
}

function findEmail(child) {

    var tr = child.parentNode.parentNode.childNodes;
    
    for (var i = 0; i < tr.length; i++) {
        
        if (tr[i].className === 'email') {
           
            var email = encodeURIComponent(tr[i].innerText);
            return [email, tr[i]];
        }
    }
}

function removeUserRequest(email, td) {
    
    var request = new XMLHttpRequest();
    request.open('POST', 'remove.php', true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send('email=' + email);
            
    request.onreadystatechange = function () {
                
        if (request.readyState == 4) {
            
            console.log(request.responseText);
            var tr = td.parentNode;
            tr.parentNode.removeChild(tr);
        }
    }
}

function makeRequest(messageOK, messageFail, target, callback) {
    
    var request = new XMLHttpRequest();
    request.open('POST', target, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
    var nome = encodeURIComponent($('#nome').val());
    var login = encodeURIComponent($('#login').val());
    var email = encodeURIComponent($('#email').val());
    var senha = encodeURIComponent($('#senha').val());
        
    var params = 
        'nome=' + nome + '&login=' + login +
        '&email=' + email + '&senha=' + senha;
    
    request.send(params);            
    request.onreadystatechange = function () {
            
        if (request.readyState === 4) {
                
            if (request.status === 201) {
			
			    if (callback) {
				    callback(request.responseText);
				}
				else {
                    $('#status').text(messageOK);
			    }
            }
            else {
			
			    if (callback) {
				    callback(null);
				}
				else {
                    $('#status').text(messageFail);
				}
            }
        }
    }  
}