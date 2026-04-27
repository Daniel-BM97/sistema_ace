<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Boletim Diário - Sistema ACE</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background: #f7f9fc;
    }

    .wrap {
      max-width: 1000px;
      margin: 28px auto;
      padding: 18px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    h2 {
      color: #006666;
      margin: 0 0 12px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 12px;
    }

    th,
    td {
      padding: 10px 8px;
      border-bottom: 1px solid #eee;
      font-size: 14px;
      text-align: left;
    }

    th {
      background: #f2f7f7;
      color: #006666;
      font-weight: 700;
    }

    .empty {
      text-align: center;
      padding: 20px;
      color: #666;
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
      padding: 12px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      display: inline-block;
      text-align: center;
      text-decoration: none;
      transition: background 0.3s, transform 0.2s;
      border: none;
    }

    .btn-voltar:hover {
      background: #1565c0;
      transform: translateY(-2px);
    }

    @media (max-width:800px) {

      th:nth-child(5),
      td:nth-child(5),
      th:nth-child(6),
      td:nth-child(6) {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div style="font-size:12px; color:#666; margin-bottom:16px;">
      <a href="index.php?page=home" style="color:#1976d2; text-decoration:none;">Home</a> &gt; <span style="color:#333; font-weight:600;">Boletim Diário</span>
    </div>
    <h2>Boletim Diário</h2>
    <p style="color:#444; margin:6px 0 12px 0;">Filtro por data e lista de imóveis com contagem de depósitos por tipo.</p>

    <!-- Filtro por Data -->
    <form method="post" style="display:flex; gap:8px; margin-bottom:16px; align-items:flex-end; flex-wrap:wrap;">
      <div style="flex:1; min-width:180px;">
        <label for="data_filtro" style="display:block; font-weight:600; color:#006666; margin-bottom:4px;">Filtrar por Data:</label>
        <input type="date" id="data_filtro" name="data_filtro" value="<?php echo htmlspecialchars($data_filtro ?? ''); ?>" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
      </div>
      <button type="submit" style="padding:8px 16px; background:#009688; color:#fff; border:none; border-radius:6px; cursor:pointer; font-weight:600;">Filtrar</button>
      <?php if (!empty($data_filtro)): ?>
        <a href="index.php?page=boletim" style="padding:8px 16px; background:#1976d2; color:#fff; text-decoration:none; border-radius:6px; font-weight:600;">Limpar</a>
      <?php endif; ?>
    </form>

    <?php if (session_status() === PHP_SESSION_NONE) {
      session_start();
    } ?>
    <?php if (!empty($_SESSION['flash'] ?? null)): ?>
      <div style="background:#e6ffed;color:#005b2e;padding:10px;border-radius:6px;margin-bottom:12px;">
        <?php echo htmlspecialchars($_SESSION['flash']);
        unset($_SESSION['flash']); ?>
      </div>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>N° Quarteirão</th>
          <th>Nome da Rua</th>
          <th>Número do Imóvel</th>
          <th>Tipo do Imóvel</th>
          <th>A1</th>
          <th>A2</th>
          <th>B</th>
          <th>C</th>
          <th>D1</th>
          <th>D2</th>
          <th>Larvicida</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($rows)): ?>
          <tr>
            <td class="empty" colspan="11">Nenhum imóvel cadastrado.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($rows as $i): ?>
            <tr>
              <td><?php echo htmlspecialchars($i['numero_quarteirao']); ?></td>
              <td><?php echo htmlspecialchars($i['nome_rua']); ?></td>
              <td><?php echo htmlspecialchars($i['numero_imovel']); ?></td>
              <td><?php echo htmlspecialchars($i['tipo_imovel']); ?></td>
              <td><?php echo (int)$i['A1']; ?></td>
              <td><?php echo (int)$i['A2']; ?></td>
              <td><?php echo (int)$i['B']; ?></td>
              <td><?php echo (int)$i['C']; ?></td>
              <td><?php echo (int)$i['D1']; ?></td>
              <td><?php echo (int)$i['D2']; ?></td>
              <td><?php echo htmlspecialchars($i['qtd_larvicida']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <p style="margin-top:14px;"><button class="btn-voltar" onclick="window.location.href='index.php?page=home';">Voltar ao Painel</button></p>
  </div>
</body>

</html>

