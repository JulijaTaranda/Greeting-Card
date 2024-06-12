<?php

require_once '_header.php';
require_once '_utilities.php';

$file_name = sanitizeFileName($_GET['name']);

if(file_exists("cards/$file_name")) {
 $card_content = file_get_contents("cards/$file_name");
}

?>

<h1 class="my-4">Card Preview</h1>
<?php if (isset($card_content)) : ?>
  <pre class="bg-light p-3"><?= $card_content ?></pre>
<?php else : ?>
   <p class="alert alert-danger"> Ooops! Something went wrong.</p>
<?php endif ?>


<?php

require_once '_footer.php';