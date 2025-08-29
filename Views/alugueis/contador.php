<?php
// Supõe que $data_devolucao vem do banco (consulta pelo aluguel)
$data_devolucao = "2025-09-01 15:00:00";
?>
<h3>Tempo restante para devolver:</h3>
<div id="contador" style="font-size:20px; color:red;"></div>

<script>
const prazo = new Date("<?= $data_devolucao ?>").getTime();

const timer = setInterval(function() {
  const agora = new Date().getTime();
  const restante = prazo - agora;

  if (restante <= 0) {
    clearInterval(timer);
    document.getElementById("contador").innerHTML = "Prazo expirado!";
  } else {
    const dias = Math.floor(restante / (1000 * 60 * 60 * 24));
    const horas = Math.floor((restante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutos = Math.floor((restante % (1000 * 60 * 60)) / (1000 * 60));
    const segundos = Math.floor((restante % (1000 * 60)) / 1000);

    document.getElementById("contador").innerHTML =
      dias + "d " + horas + "h " + minutos + "m " + segundos + "s";
  }
}, 1000);
</script>


