<?php

require_once '_header.php';
require_once '_utilities.php';

function makeGreetingCard($sender, $recipient, $template) {
  $file_name= sanitizeFileName("$sender-$recipient.txt");
  $message = file_get_contents($template);
  $file = fopen("cards/$file_name", "w");
  fwrite($file, "Dear $recipient, \n\n");
  fwrite($file, "$message\n\n");
  fwrite($file, "Sicerely, \n");
  fwrite($file, "$sender");
  fclose($file);
  return $file_name;
}
//For testing makeGreetingCard function
//If it works, in filder cards appears new card with name Sal Mary
//makeGreetingCard("Sal", "Mary", "thank_you.txt");


//if we have submitted form, then
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender = $_POST['sender'];
  $recipient = $_POST['recipient'];
  $template = $_POST['template'];

  $file_name = makeGreetingCard($sender, $recipient, $template);

//good practice - when we redirect user, then write exit
  header("Location: /card.php?name=$file_name");
  exit;
}

?>

<h1 class="my-4">Create a Greeting Card</h1>
<form method="post">
    <div class="my-3">
        <label for="sender" class="form-label">Sender Name</label>
        <input type="text" name="sender" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="recipient" class="form-label">Recipient Name</label>
        <input type="text" name="recipient" class="form-control" required>
    </div>

    <div class="my-3">
        <label for="template" class="form-label">Template</label>
        <select name="template" class="form-select" required>
            <option value="">Choose a Template</option>
            <option value="birthday.txt">Birthday</option>
            <option value="thank_you.txt">Thank You</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-1">Create Card</button>
</form>

<?php

require_once '_footer.php';
