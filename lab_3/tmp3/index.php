<?php require "connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style_lab1.css" rel="stylesheet" type="text/css" />
  <link href="style_lab3.css" rel="stylesheet" type="text/css" />
  <title>lab_3</title>
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
          <p class="header-text" id="header">
            From classic perfumes to the iconic little black dress, CHANEL is undoubtedly one of the most iconic fashion houses of all time. As the timeless fragrance, CHANEL No. 5, marks its 100th birthday in 2021, it’s a good time to take a look back into the history of CHANEL.
          </p>
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
                    <a href="list.php">List</a>
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
              <h1>Automatic element creation</h1>
              <form class="automatic-element-creation-form" action="create_element.php" method="POST">
                <?php if (isset($_GET["edit"])) { ?>
                  <input type="hidden" name="id" value="<?= $_GET["edit"] ?>">
                <?php } ?>
                <p><b>NOTE!</b> In order or this form to work, your browser must support and turn on JavaScript, template tags, ajax and color inputs</p>
                <hr>
                <?php if (isset($_GET["edit"])) {
                  $element = $pdo->prepare("SELECT * FROM `elements` WHERE `id` = ?");
                  $element->execute([$_GET["edit"]]);
                  $element = $element->fetch();

                  $tabs = $pdo->prepare("SELECT * FROM `tabs` WHERE `element_id` = ?");
                  $tabs->execute([$element["id"]]);
                  $tabs = $tabs->fetchAll(PDO::FETCH_ASSOC);
                } ?>
                <div class="row">
                  <div class="col">
                    <div class="group">
                      <label for="title">Title of the block: </label>
                      <input type="text" name="title" id="title" value="<?= $element["title"] ?>">
                    </div>
                  </div>
                  <div class="col">
                    <div class="group">
                      <label>Accent color:</label>
                      <input type="color" name="accent_color" value="<?= $element["accent_color"] ?>">
                    </div>
                  </div>
                  <div class="col">
                    <div class="group">
                      <label>Second color:</label>
                      <input type="color" name="second_color" value="<?= $element["second_color"] ?>">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col">
                    <div class="add-row">
                      <span>Add row</span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="upload-element">
                      <button>Upload element</button>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="tab-list">
                  <?php foreach ($tabs as $tab) { ?>
                    <div class="tab-item">
                      <div class="move">
                        <span class="up">&#x27A7;</span>
                        <span class="down">&#x27A7;</span>
                      </div>
                      <div class="title">
                        <input type="text" name="name[]" placeholder="Tab name" class="name" value="<?= $tab["name"] ?>">
                      </div>
                      <div class="text">
                        <textarea name="content[]" placeholder="Tab content"><?= $tab["content"] ?></textarea>
                      </div>
                      <div class="remove">
                        <span>Remove</span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </form>
              <template id="tab-item-template">
                <div class="tab-item">
                  <div class="move">
                    <span class="up">&#x27A7;</span>
                    <span class="down">&#x27A7;</span>
                  </div>
                  <div class="title">
                    <input type="text" name="name[]" placeholder="Tab name" class="name">
                  </div>
                  <div class="text">
                    <textarea name="content[]" placeholder="Tab content"></textarea>
                  </div>
                  <div class="remove">
                    <span>Remove</span>
                  </div>
                </div>
              </template>
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
      <h2 class="footer-logo bordered" id="name">Anastasiia Titova</h2>
      <p id="footer">
        From classic perfumes to the iconic little black dress, CHANEL is undoubtedly one of the most iconic fashion houses of all time.
      </p>
    </div>
  </div>

  <script src="main.js"></script>
</body>

</html>