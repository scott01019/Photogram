<?php require_once __DIR__ . '/../../../php/filters/user_only_auth.php';

if (!isset($_SESSION)) session_start(); //  start session if needed
if (isset($_SESSION['message_errors'])) {   //  display errors if they exist
  echo '<div class="alert alert-danger text-center col-md-5 col-md-offset-3" role="alert">' . $_SESSION['message_errors'] . '</div>';
  unset($_SESSION['message_errors']);   //  delete errors
}

$_SESSION['recip'] = isset($_GET['user']) ? $_GET['user'] : ''; //  set recipient to the GET['user'] variable
?>
<form class="form-horizontal col-md-6 col-md-offset-2 form" method='post' action='../../php/commands/send_message.php'>
    <div class="form-group">
        <label for="subject" class="col-sm-4 control-label">Subject</label>
        <div class="col-sm-8">
            <input type="text" name='subject' class="form-control" id="subject" placeholder="Subject" required>
        </div>
    </div>
    <div class='form-group'>
        <label for="text" class="control-label col-sm-4">Text</label>
        <div class='col-sm-8'>
            <textarea class="form-control" id="text" name="text" maxlength="140" placeholder="140 characters" required style='resize: none'></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
            <button type="submit" class="btn btn-default">Send</button>
        </div>
    </div>
</form>
