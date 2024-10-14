// Rolagem de texto
function autoResize(textarea) {
    textarea.style.height = 'auto'; // Reseta a altura
    textarea.style.height = textarea.scrollHeight + 'px'; // Ajusta a altura conforme o conteúdo
}


// Preview de Imagem
function previewImage(event) {
    const imagePreview = document.getElementById('preVizuliazarImagem');
    const imagePreviewContainer = document.getElementById('preVizualizarID');
   
    const file = event.target.files[0]; // Obtém o arquivo da entrada
    if (file) {
        const reader = new FileReader(); // Cria um objeto FileReader
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Define a imagem de pré-visualização
            imagePreviewContainer.style.display = 'block'; // Mostra o contêiner da imagem
            imagePreview.classList.add('preVizualizarImagem');
        }
        reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
    }
}


// Vantagens e Desvantagens
let classes = [
    { nome: "Avareza", vida: 50, vitalidade: 30, vantagems: ["Maldição", "Astúcia", "Violação"], desvantagens: ["Presteza", "Auge", "Crueldade", "Obstinação"] },
    { nome: "Fraude", vida: 50, vitalidade: 45, vantagems: ["Maldição", "Astúcia", "Violação", "Presteza"], desvantagens: ["Auge", "Crueldade", "Obstinação"] },
    { nome: "Gula", vida: 80, vitalidade: 50, vantagems: ["Maldição", "Auge", "Violação", "Obstinação"], desvantagens: ["Presteza", "Astúcia", "Crueldade"] },
    { nome: "Heresia", vida: 40, vitalidade: 80, vantagems: ["Maldição", "Astúcia", "Violação"], desvantagens: ["Presteza", "Auge", "Crueldade", "Obstinação"] },
    { nome: "Ira", vida: 50, vitalidade: 50, vantagems: ["Astúcia", "Auge", "Violação", "Obstinação"], desvantagens: ["Maldição", "Presteza", "Crueldade"] },
    { nome: "Luxúria", vida: 50, vitalidade: 80, vantagems: ["Maldição", "Astúcia", "Violação", "Presteza"], desvantagens: ["Auge", "Crueldade", "Obstinação"] },
    { nome: "Traição", vida: 50, vitalidade: 60, vantagems: ["Presteza", "Astúcia", "Violação"], desvantagens: ["Maldição", "Auge", "Crueldade", "Obstinação"] },
    { nome: "Violência", vida: 70, vitalidade: 30, vantagems: ["Crueldade", "Astúcia", "Violação", "Obstinação"], desvantagens: ["Maldição", "Presteza", "Auge"] }
];


// Função para exibir as vantagens e desvantagens com base na classe escolhida
function exibirVantagensDesvantagens() {
    // Obtém a classe selecionada
    let classeSelecionada = document.querySelector('input[name="classe"]:checked').value;


    // Procura a classe selecionada no array
    let classe = classes.find(c => c.nome === classeSelecionada);


    // Verifica se a classe foi encontrada
    if (classe) {
        // Limpa a lista de vantagens e desvantagens
        let listaVantagens = document.getElementById('vantagens');
        let listaDesvantagens = document.getElementById('desvantagens');
        listaVantagens.innerHTML = "";
        listaDesvantagens.innerHTML = "";


        // Adiciona as vantagens à lista com controle de quantidade
        classe.vantagems.forEach(function(vantagem) {
            let li = document.createElement('li');
            li.innerHTML = `
                ${vantagem}
                <input type="number" style="color:black" class="valor" data-tipo="vantagem" data-nome="${vantagem}" name="${vantagem}" value="0"></input>
            `;
            listaVantagens.appendChild(li);
        });


        // Adiciona as desvantagens à lista com controle de quantidade
        classe.desvantagens.forEach(function(desvantagem) {
            let li = document.createElement('li');
            li.innerHTML = `
                ${desvantagem}
                <input type="number" style="color:black" class="valor" data-tipo="desvantagem" data-nome="${desvantagem}" name="${desvantagem}" value="0"></input>
            `;
            listaDesvantagens.appendChild(li);
        });
    }
}


//testar a soma
function validarSomas() {
    let somaVantagem = 0;
    let somaDesvantagem = 0;


    document.querySelectorAll('input[data-tipo="vantagem"]').forEach(input => {
        somaVantagem += parseInt(input.value) || 0; // Acessa o valor atual do input
    });


    document.querySelectorAll('input[data-tipo="desvantagem"]').forEach(input => {
        somaDesvantagem += parseInt(input.value) || 0; // Acessa o valor atual do input
    });


    if (somaVantagem != 10){
        alert("A soma das vantagens deve ser igual a 10!");
        return false;
    } else if (somaDesvantagem != 10){
        alert("A soma das desvantagems deve ser igual a 10!");
        return false;
    } else {
        return true;
    }


}


// Adiciona evento de mudança ao selecionar uma classe
document.querySelectorAll('input[name="classe"]').forEach(input => {
    input.addEventListener('change', exibirVantagensDesvantagens);
});


// Função para obter a soma total de vantagens
function obterSomaVantagens() {
    let total = 0;
    document.querySelectorAll('.valor[data-tipo="vantagem"]').forEach(span => {
        total += parseInt(span.value) || 0; // Alterado de textContent para value
    });
    return total;
}


// Função para obter a soma total de desvantagens
function obterSomaDesvantagens() {
    let total = 0;
    document.querySelectorAll('.valor[data-tipo="desvantagem"]').forEach(span => {
        total += parseInt(span.value) || 0; // Alterado de textContent para value
    });
    return total;
}


function atualizar(nome, valor, tipo) {
    // Seleciona o campo oculto diretamente pelo nome do atributo
    let input = document.querySelector(`input[name="${nome}"]`);


    if (!input) {
        console.error(`Campo oculto para ${nome} não encontrado`);
        return;
    }


    // Converte o valor atual do input em número (ou inicializa como 0)
    let valorAtual = parseInt(input.value) || 0;


    // Atualiza o valor do atributo
    valorAtual += valor;


    // Se o valor for 0 ou menor, redefina para 0 (ou você pode optar por remover o input)
    if (valorAtual <= 0) {
        valorAtual = 0;
    }


    // Atualiza o valor do campo oculto com o novo valor
    input.value = valorAtual;


    // Atualiza também os spans visuais na interface
    let span = document.querySelector(`.valor[data-nome="${nome}"][data-tipo="${tipo}"]`);
    if (span) {
        span.value = valorAtual; // Alterado de textContent para value
    }
}


function atualizarCamposOcultos(nome, valor, tipo) {
    let inputId = tipo === 'vantagem' ? 'vantagens-input' : 'desvantagens-input';
    let input = document.getElementById(inputId);


    // Parse do JSON existente (ou cria um objeto vazio)
    let valoresAtuais = JSON.parse(input.value || '{}');


    // Atualiza o valor no objeto
    valoresAtuais[nome] = valor;


    // Converte o objeto de volta para JSON e atribui ao input
    input.value = JSON.stringify(valoresAtuais);
}


// Evento de submissão do formulário
document.getElementById('seuFormularioID').addEventListener('submit', function(event) {
    validarSomas();
    if (validarSomas() == false) {
        event.preventDefault(); // Impede a submissão se a validação falhar
    } else {
        manipularValores(); // Atualiza os campos ocultos antes de enviar
    }
});


// Execute a função para exibir as vantagens e desvantagens ao carregar a página
document.addEventListener("DOMContentLoaded", exibirVantagensDesvantagens);
