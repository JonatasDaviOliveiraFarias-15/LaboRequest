<?php
session_start();

require_once 'funcoes.php';
$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];
$tipo=$u->buscarTipoConta($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaboRequest</title>
    <link rel="stylesheet" href="estiloPrincipal.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php if($tipo==1){ ?>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href=""><div class="logo"><img src="logo2.png" alt="Logo2" width="40px" height="40px"><img src="logo.png" alt="Logo"></div></a>
                <a href="../LaboRequest/verVagas/verVagas.php">Minhas Vagas</a>
                <a href="../LaboRequest/pesquisa/pesquisa.php">Encontrar Trabalhos</a>
                <a href="../LaboRequest/perfil/perfil.php">Editar Perfil</a>
                <a href="../LaboRequest/deslogar.php">Deslogar</a>
            </nav>
        </div>
    </header>
    <?php } ?>
    <?php if($tipo==2){ ?>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href=""><div class="logo"><img src="logo2.png" alt="Logo2" width="40px" height="40px"><img src="logo.png" alt="Logo"></div></a>
                <a href="../LaboRequest/login/login.php">Minhas Vagas</a>
                <a href="../LaboRequest/cadastroVagas/cadastroVagas.php">Adicionar Vagas</a>
                <a href="../LaboRequest/perfil/perfil.php">Editar Perfil</a>
                <a href="../LaboRequest/deslogar.php">Deslogar</a>
            </nav>
        </div>
    </header>
    <?php } ?>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Seu Trabalho, Nossa Conexão</h1>
                    <h1 style="color: #ff6600;">5000+ JOBS</h1>
                    <p>Para você que busca oportunidades de emprego, alavancar a carreira ou precisa de prestadores de serviços de confiança.</p>
                </div>
                <div class="hero-image">
                    <img src="design-b3dcb2a2-23f6-41f0-b740-595184e6d3e9 1.png" alt="Pessoa sorrindo" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2>Explore por <span>categorias</span></h2>
            <div class="categories-grid">
                <div class="category">Bem-Estar <span><?php $val1=$u->buscarQuantidadeVagas("bemEstar");print_r($val1["count"]);?> vagas disponíveis</span></div>
                <div class="category">Educação <span><?php $val2=$u->buscarQuantidadeVagas("educacao");print_r($val2["count"]);?> vagas disponíveis</span></div>
                <div class="category">Tecnologia <span><?php $val3=$u->buscarQuantidadeVagas("tecnologia");print_r($val3["count"]);?> vagas disponíveis</span></div>
                <div class="category">Saúde <span><?php $val4=$u->buscarQuantidadeVagas("saude");print_r($val4["count"]);?> vagas disponíveis</span></div>
                <div class="category">Serviços Especializados <span><?php $val5=$u->buscarQuantidadeVagas("serEsp");print_r($val5["count"]);?> vagas disponíveis</span></div>
                <div class="category">Outros <span><?php $val6=$u->buscarQuantidadeVagas("outros");print_r($val6["count"]);?> vagas disponíveis</span></div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <h2>Dúvidas <span>Frequentes</span></h2>
            <ul class="faq-list">
                <li>
                    Direitos do Empregado <span class="arrow">&#x25BC;</span>
                    <div class="answer">Ter mais de um vínculo empregatício ao mesmo tempo;
Remuneração por hora trabalhada, que não pode ser inferior ao valor horário do salário mínimo, ao piso salarial da categoria ou àquele devido aos demais empregados que exercem a mesma função, em contrato intermitente ou não;
13º proporcional às horas trabalhadas no ano;
Férias proporcionais ao período trabalhado (30 dias de férias a cada 12 meses trabalhados), com acréscimo de 1/3 sobre o valor da remuneração, podendo ser fracionada caso haja acordo entre as partes;
1 dia de descanso remunerado na semana, preferencialmente aos domingos;
Prazo de 1 dia útil para responder à oferta de comparecimento ao trabalho, sendo presumido a recusa em caso de silêncio;
Recusar a oferta de comparecimento ao trabalho, sem que isso descaracterize o vínculo empregatício (subordinação);
Depósito do FGTS (Fundo de Garantia por Tempo de Serviço) sobre o valor pago a cada período de trabalho.
</div>
                </li>
                <li>
                    Deveres do Empregado <span class="arrow">&#x25BC;</span>
                    <div class="answer">Cumprir com a oferta de trabalho após aceitá-la, salvo justificativa de ausência;
Respeitar os limites da jornada de trabalho (8 horas diárias, com a possibilidade de 2 horas extras, e 44 horas semanais);
Cumprir os regimentos e normas internas de conduta, vestimenta, segurança e saúde.
</div>
                </li>
                <li>
                    Direitos do Empregador <span class="arrow">&#x25BC;</span>
                    <div class="answer">Requisitar a presença do empregado, desde que com pelo menos 3 dias corridos (72h) de antecedência;
Convocar o trabalhador de forma esporádica, conforme a necessidade do serviço, sem a obrigatoriedade de jornada fixa, podendo ser para dias e horários específicos;
Rescindir o contrato de trabalho intermitente a qualquer momento, desde que cumpra as formalidades legais, como o pagamento das verbas rescisórias, mesmo em caso de demissão sem justa causa;
Contratar o empregado sem a necessidade de vínculo com uma jornada integral ou contínua;
Dar ordens e controlar a execução das atividades do empregado durante os períodos de trabalho (poder de subordinação).
</div>
                </li>
                <li>
                    Deveres do Empregador <span class="arrow">&#x25BC;</span>
                    <div class="answer">Oferecer uma remuneração não inferior ao valor horário do salário mínimo, ao piso salarial da categoria ou àquele devido aos demais empregados que exercem a mesma função, em contrato intermitente ou não;
Pagar o 13º proporcional às horas trabalhadas no ano;
Garantir férias proporcionais ao período trabalhado (30 dias de férias a cada 12 meses trabalhados), com acréscimo de 1/3 sobre o valor da remuneração, podendo ser fracionada caso haja acordo entre as partes;
Dar 1 dia de descanso remunerado semanal;
Fazer o depósito do FGTS (Fundo de Garantia por Tempo de Serviço) sobre o valor pago a cada período de trabalho.
</div>
                </li>
            </ul>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="logo2.png" alt="Logo2" width="40px" height="40px">
                    <img src="logo.png" alt="Logo">
                </div>
                <p>O Trabalho Intermitente, introduzido pela Reforma Trabalhista de 2017 e validado pelo STF em 2024, é um vínculo empregatício previsto na CLT. Nesse modelo, o trabalhador presta serviços de forma esporádica, sem jornada fixa, sendo convocado conforme a necessidade do empregador e recebe proporcionalmente ao período trabalhado.</p>
            </div>
            <div class="footer-bottom">
                <p>2024©LaboRequest. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('.faq-list li').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('open');
            });
        });
    </script>
</body>
</html>

