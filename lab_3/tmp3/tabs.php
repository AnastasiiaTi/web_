<?php function tabs($id, $title, $names, $contents, $accentColor, $secondColor)
{ ?>
  <h3><?= $title ?></h3><br>
  <div class="tabset" data-id="<?= $id ?>">
    <?php foreach ($names as $i => $name) { ?>
      <!-- Tab <?= $i ?> -->
      <input type="radio" name="tabset__<?= $id ?>" id="tab<?= $i ?>__<?= $id ?>" aria-controls="content<?= $i ?>__<?= $id ?>" <?php echo $i === 0 ? "checked" : ""; ?>>
      <label for="tab<?= $i ?>__<?= $id ?>"><?= $name ?></label>
    <?php } ?>
    <div class="tab-panels">
      <?php foreach ($contents as $i => $content) { ?>
        <section id="content<?= $i ?>__<?= $id ?>" class="tab-panel">
          <p><?= $content ?></p>
        </section>
      <?php } ?>
    </div>
  </div>
  <style>
    .tabset[data-id='<?= $id ?>'] .tab-panel,
    .tabset[data-id='<?= $id ?>'] .tab-panels {
      border-color: <?= $secondColor ?>;
    }

    .tabset[data-id='<?= $id ?>']>label::after {
      background: <?= $secondColor ?>;
    }

    .tabset[data-id='<?= $id ?>']>label:hover {
      color: <?= $accentColor ?>;
    }

    .tabset[data-id='<?= $id ?>']>input:focus+label {
      color: <?= $accentColor ?>;
    }

    .tabset[data-id='<?= $id ?>']>label:hover::after,
    .tabset[data-id='<?= $id ?>']>input:focus+label::after,
    .tabset[data-id='<?= $id ?>']>input:checked+label::after {
      background: <?= $accentColor ?>;
    }

    .tabset>input:checked+label {
      border-color: <?= $secondColor ?>;
    }
  </style>
<?php } ?>