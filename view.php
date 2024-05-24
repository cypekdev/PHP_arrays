<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tablice</title>
  <link rel="stylesheet" href="style/main.css">
</head>
<body>

<main id="main-content">

  <form method="POST">
    <input type="text" name="new_array_name" placeholder="nazwa nowej tablicy">
    <button name="btn-data" value="NEW_ARRAY">Utwórz nową tablicę</button>
  </form>

  <div id="tables">

  <?php foreach ($arrays as $array_name => $myArray): ?>
    <div>
      <form method="POST">
        <table>
          <thead>
            <tr>
              <th colspan="2"><?= $array_name ?></th>
              <th>
                <button name="btn-data" value="DEL_ARR-<?= $array_name ?>">Usuń</button>
              </th>
            </tr>
            <tr>
              <th>Klucz:</th>
              <th>Wartość:</th>
              <td>
                <button name="btn-data" value="EMPTY-<?= $array_name ?>">Empty</button>
              </td>
            </tr>
            <tr>
              <td><input type="text" name="unshift_key" size="2"></td>
              <td><input type="text" name="unshift_value" placeholder="unshift"></td>
              <td>
                <button name="btn-data" value="SHIFT-<?= $array_name ?>">shift</button>
              </td>
            </tr>
          </thead>

          <tbody>
          <?php foreach ($myArray as $key => $value): ?>
            <tr>
              <td><?= $key ?></td>
              <td><?= $value ?></td>
              <td>
                <button name="btn-data" value="REMOVE-<?= $array_name ?>-<?= $key ?>">Remove</button>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>

          <tfoot>
            <tr>
              <td><input type="text" name="push_key" size="2"></td>
              <td><input type="text" name="push_value" placeholder="push"></td>
              <td>
                <button name="btn-data" value="POP-<?= $array_name ?>">pop</button>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <button class="execute-button" name="btn-data" value="EXECUTE-<?= $array_name ?>">Wykonaj</button>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>

  <?php endforeach; ?>

  </div>

</main>
  
</body>
</html>
