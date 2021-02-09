edicoesInovativa();
destaquePatente();
corrigeTextoTH();

function corrigeTextoTH(){
if (document.body.classList == 'pagina-dados-abertos-pi') {
	
	const seta = '<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span>';
	
	document.getElementsByTagName('th')[0].innerHTML = 'Número' + seta;
	document.getElementsByTagName('th')[1].innerHTML = 'Título' + seta;
	document.getElementsByTagName('th')[2].innerHTML = 'Propriedade' + seta;
	document.getElementsByTagName('th')[3].innerHTML = 'Situação' + seta;
	}
}

function destaquePatente() {
    if (document.body.classList == 'pagina-dados-abertos-pi') {
        let linha = document.querySelector('.patentes').getElementsByTagName('tr');
        let celulas = document.querySelector('.patentes').getElementsByTagName('td');
        celulas = Array.from(celulas);

        celulas.forEach(function (celula) {
            if (celula.innerText == 'Concedido' || celula.innerText == 'Deferido') {
                celula.style.color = 'green';
            }
        });
    }
}

function edicoesInovativa(){
	const url = window.location.pathname;

	if (url === '/int/revista-inovativa' || url === '/revista-inovativa') {
        	document.querySelector('.k-js-grid-controller').remove();
	} else {
        if (url === '/int/revista-inovativa-edicoes' || url === '/revista-inovativa-edicoes') {
        	const edicoes = document.querySelector('.koowa_media');
                const atual = edicoes.children[0];
                const anteriores = edicoes.children[1];

                atual.classList.add('atual');
                anteriores.classList.add('anteriores');
                } else {
            //console.log('Nada a fazer')
       	}
       } 
}