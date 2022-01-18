<?php require "connect.php"; ?>
<?php require "tabs.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style_lab1.css" rel="stylesheet" type="text/css" />
  <link href="style_lab3.css" rel="stylesheet" type="text/css" />
  <link href="tabs.css" rel="stylesheet" type="text/css" />
  <title>lab_1_list</title>
</head>

<body>
  <div class="root">

    <div class="content">
      <div class="left-sidebar bordered">
        <h3>1960s – Celebrities in CHANEL</h3>
        <p>
          At the peak of CHANEL, many of the most prominent women of the era wore CHANEL regularly. From actress Romy Schneider, model Dorothea McGowan to the former first lady of the United States Jackie Kennedy, CHANEL truly became a household name.
        </p>
        <h3>
          1971 – The Loss of a Legend history of chanel
        </h3>
        <p>
          On 10 January 1971, Mademoiselle Chanel passed away at the Hotel Ritz in Paris.
        </p>
      </div>
      <div class="base">
        <div class="header bordered">
          <p class="header-text">
            These are the best and some of my all-time favorite Coco Chanel quotes! Use these quotes for your inspiration and even life advice. A lot of these Coco Chanel Quotes pertain to how we look, how we take care of ourselves and of course fashion.</p>
          <h1 class="logo bordered">Chanel</h1>
        </div>
        <div class="page">
          <div class="main-part ">
            <div class="menu bordered no-padding">
              <nav>
                <ul>
                  <li>
                    <a href="index.php">Home</a>
                  </li>
                  <li>
                    <a href="list.html">List</a>
                  </li>
                  <li>
                    <a href="ordered-list.html">Ordered list</a>
                  </li>
                  <li>
                    <a href="images.html">Images</a>
                  </li>
                  <li>
                    <a href="map.html">Map</a>
                  </li>
                  <li>
                    <a href="form.html">Form</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="block bordered">
              <?php if (isset($_GET["remove"])) { ?>
                <?php
                $pdo->prepare("DELETE FROM `tabs` WHERE element_id=?")->execute([$_GET["remove"]]);
                $pdo->prepare("DELETE FROM `elements` WHERE id=?")->execute([$_GET["remove"]]);
                ?>
                <p id="deleted-ok" style="font-weight:bold;color:green">Element deleted succesfully</p>
                <script>
                  setTimeout(() => document.querySelector("#deleted-ok").remove(), 2000)
                </script>
              <?php } ?>
              <br>
              <h1>Select section to edit:</h1>
              <?php
              $elements = $pdo->query("SELECT * FROM `elements`")->fetchAll(PDO::FETCH_ASSOC);
              $tabs = $pdo->query("SELECT * FROM `tabs`")->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <?php foreach ($elements as $element) { ?>
                <div class="tabs">
                  <?php
                  $currentTabs = array_filter($tabs, function ($tab) use ($element) {
                    return $tab["element_id"] === $element["id"];
                  });

                  $currentNames = [];
                  $currentContents = [];

                  foreach ($currentTabs as $currentTab) {
                    $currentNames[] = $currentTab["name"];
                    $currentContents[] = $currentTab["content"];
                  }
                  ?>
                  <?php tabs(
                    $element["id"],
                    $element["title"],
                    $currentNames,
                    $currentContents,
                    $element["accent_color"],
                    $element["second_color"]
                  ); ?>
                </div>
                <br>
                <div class="edit">
                  <h3>Options:</h3>
                  <a class="edit-link" href="index.php?edit=<?= $element["id"] ?>">Edit</a>
                  <a class="remove-link" href="?remove=<?= $element["id"] ?>">Remove</a>
                </div>
                <br>
                <hr>
                <br>
              <?php }
              if (count($elements) < 1) { ?>
                <p>No elements created</p>
                <p>Go to <a href="index.php">this page</a> to create one</p>
              <?php } ?>
            </div>
          </div>
          <div class="right-sidebar bordered">
            <h3>
              1931 – CHANEL Meets Hollywood
            </h3>
            <p>
              At the personal request of Samuel Goldwyn, Gabrielle Chanel went to Hollywood to create outfits for the leading stars both on and off the screen. She designed outfits for the likes of Gloria Swanson, Madge Evans and Barbara Weeks. When Hollywood dismissed her looks for being too clean, Gabrielle Chanel chose not to compromise and walked away.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer bordered">
      <h2 class="footer-logo bordered">Anastasiia Titova</h2>
      <p class="footer-text">Fashion changes, but style endures. Fashion changes, but style endures.Fashion changes, but style endures. Fashion changes, but style endures</p>
    </div>
  </div>
</body>

</html>