<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imóveis Cadastrados</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    /* Global box-sizing para evitar overflow inesperado */
    *, *::before, *::after { box-sizing: border-box; }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #ffffff;
      margin: 0;
      padding: 40px 0;
    }

    .container {
      background: #fff;
      width: 95%;
      max-width: 950px;
      padding: 22px;
      border-radius: 16px;
      box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.15);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .container:hover {
      transform: translateY(-5px);
      box-shadow: 0px 12px 35px rgba(0, 0, 0, 0.25);
    }

    h2 {
      color: #006666;
      font-size: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      border-bottom: 1px solid #ddd;
      text-align: left;
      padding: 10px;
      font-size: 14px;
    }

    th {
      color: #006666;
      font-weight: bold;
      background: #f2f2f2;
    }

    tr:hover {
      background: #f9f9f9;
    }

    .btn {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .btn:hover {
      transform: translateY(-2px);
    }

    .btn-trabalhar {
      background: #009688;
      color: white;
    }

    .btn-trabalhar:hover {
      background: #00796b;
    }

    .btn-voltar {
      margin-top: 20px;
      background: #1976d2;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-voltar:hover {
      background: #1565c0;
      transform: translateY(-2px);
    }

    @media (max-width: 700px) {
      .container {
        width: 96%;
        padding: 14px;
      }

      th,
      td {
        font-size: 13px;
        padding: 8px;
      }

      .btn {
        font-size: 13px;
        padding: 8px;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <div style="font-size:12px; color:#666; margin-bottom:16px;">
      <a href="index.php?page=home" style="color:#1976d2; text-decoration:none;">Home</a> &gt; <a href="index.php?page=area" style="color:#1976d2; text-decoration:none;">Áreas</a> &gt; <a href="index.php?page=rg&cod_area=<?php echo urlencode($_GET['cod_area'] ?? ''); ?>" style="color:#1976d2; text-decoration:none;">Quarteirões</a> &gt; <span style="color:#333; font-weight:600;">Imóveis</span>
    </div>
    <h2>Imóveis Cadastrados</h2>

    <table>
      <thead>
        <tr>
          <th>N° Quarteirão</th>
          <th>Nome da Rua</th>
          <th>Número do Imóvel</th>
          <th>Tipo do Imóvel</th>
          <th>Qtd. Habitantes</th>
          <th>Qtd. Cães</th>
          <th>Qtd. Gatos</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($imoveis)): ?>
          <tr>
            <td colspan="8" style="text-align:center;">Nenhum imóvel cadastrado.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($imoveis as $i): ?>
            <tr>
              <td><?php echo $numero_quarteirao; ?></td>
              <td><?php echo htmlspecialchars($i['nome_rua']); ?></td>
              <td><?php echo htmlspecialchars($i['numero_imovel']); ?></td>
              <td><?php echo htmlspecialchars($i['tipo_imovel']); ?></td>
              <td><?php echo htmlspecialchars($i['qtd_habitantes']); ?></td>
              <td><?php echo htmlspecialchars($i['qtd_caes']); ?></td>
              <td><?php echo htmlspecialchars($i['qtd_gatos']); ?></td>
              <td>
                <form action="index.php" method="get">
                  <input type="hidden" name="page" value="visita">
                  <input type="hidden" name="id_imovel" value="<?php echo (int)$i['id_imovel']; ?>">
                  <button class="btn btn-trabalhar" type="submit">Trabalhar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <form method="post" action="index.php?page=cadastro&id_quarteirao=<?php echo $id_quarteirao ?>">
      <button type="submit" class="btn btn-trabalhar">Cadastrar Imóvel</button>
    </form>
    <button class="btn-voltar" onclick="window.location.href='index.php?page=rg&cod_area=<?php echo urlencode($_GET['cod_area'] ?? ''); ?>'">Voltar</button>
  </div>

  <script>
    function trabalhar(id) {
      alert("🔍 Acessando o imóvel ID " + id);
      // Aqui pode redirecionar: window.location.href = 'detalhes_imovel.php?id=' + id;
    }
  </script>

</body>

</html>

