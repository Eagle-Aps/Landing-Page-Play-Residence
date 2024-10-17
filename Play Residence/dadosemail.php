<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $nome = htmlspecialchars(trim($_POST['cf_seu_nome_0']));
    $cpf = htmlspecialchars(trim($_POST['cf_n_do_cpf_ou_cnpj_que_adquiriu_a_unidade']));
    $indicado = htmlspecialchars(trim($_POST['cf_nome_do_da_pessoa_que_voce_quer_indicar']));
    $telefone = htmlspecialchars(trim($_POST['cf_telefone_da_pessoa_que_voce_quer_indicar']));

    if (!empty($email) && !empty($nome) && !empty($cpf) && !empty($indicado) && !empty($telefone)) {
        
        $destinatario = "marketing@grupolirios.com.br";
        $assunto = "Nova Indicação Recebida";
        $mensagem = "
        Nova Indicação - Play Residence\n
        Nome: $nome\n
        Email: $email\n
        CPF ou CNPJ: $cpf\n
        Nome do Indicado: $indicado\n
        Telefone do Indicado: $telefone\n
        ";
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();
                   
        if (mail($destinatario, $assunto, $mensagem, $headers)) {
            echo json_encode(["status" => "success", "message" => "Indicação enviada com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erro ao enviar a indicação. Tente novamente."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos obrigatórios."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método inválido."]);
}
?>