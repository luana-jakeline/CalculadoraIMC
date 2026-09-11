<?php

class Pessoa
{
    private string $nome;
    private float $peso;
    private float $altura;

    public function __construct(string $nome, float $peso, float $altura)
    {
        $this->nome = $nome;
        $this->peso = $peso;
        $this->altura = $altura;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getAltura(): float
    {
        return $this->altura;
    }
}



function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}



function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc < 25) {
        return "Peso normal";
    } elseif ($imc < 30) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}


$nome = "";
$peso = "";
$altura = "";
$imc = "";
$classificacao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];

    if ($peso > 0 && $altura > 0) {

        $pessoa = new Pessoa($nome, $peso, $altura);

        $imc = calcularIMC(
            $pessoa->getPeso(),
            $pessoa->getAltura()
        );

        $classificacao = classificarIMC($imc);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC</title>
</head>

<body>

    <h1>Calculadora de IMC</h1>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>Peso (kg):</label>
        <input type="number" name="peso" step="0.1" required>

        <br><br>

        <label>Altura (m):</label>
        <input type="number" name="altura" step="0.01" required>

        <br><br>

        <button type="submit">Calcular IMC</button>

    </form>

    <?php if ($imc != ""): ?>

        <h2>Resultado</h2>

        <p>
            Nome:
            <?php echo htmlspecialchars($pessoa->getNome()); ?>
        </p>

        <p>
            Seu IMC é:
            <?php echo number_format($imc, 2); ?>
        </p>

        <p>
            Classificação:
            <?php echo $classificacao; ?>
        </p>

    <?php endif; ?>

</body>
</html>

