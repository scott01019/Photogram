<?php require_once __DIR__ . '/../../../php/filters/user_only_auth.php'; ?>

<?php
    if (!isset($_SESSION)) session_start(); //  start session if needed
    if (isset($_SESSION['postcard_errors'])) {  //  display errors if they exist
        echo '<div class="alert alert-danger text-center col-md-7 col-md-offset-2" role="alert">' . $_SESSION['postcard_errors'] . '</div>';
        unset($_SESSION['postcard_errors']);    //  delete errors
    }

    $_SESSION['recip'] = isset($_GET['user']) ? $_GET['user'] : $_SESSION['username'];  //  determine and assign recipient of postcard
?>

<form id="form" class="form-horizontal col-md-8 col-md-offset-3" method="POST" action="../../php/commands/upload_postcard.php" enctype="multipart/form-data">
    <div class='row'>
        <div class='form-group col-md-3'>
            <span class='btn btn-default btn-file'>
                Browse for Image<input type="file" id="upload" name="upload" accept="image/*">
            </span>
        </div>

        <div class='form-group col-md-3'>
            <select id='filterSelect' class='form-control' name='filter'>
                <option value='original'>No Filter</option>
                <option value='1977'>1977</option>
                <option value='Amaro'>Amaro</option>                           
                <option value='Brannan'>Brannan</option>                            
                <option value='Earlybird'>Earlybird</option> 
                <option value='Grayscale'>Grayscale</option>                          
                <option value='Hefe'>Hefe</option>
                <option value='Hudson'>Hudson</option>                            
                <option value='Inkwell'>Inkwell</option>
                <option value='Kelvin'>Kelvin</option>
                <option value='LoFi'>LoFi</option>
                <option value='Mayfair'>Mayfair</option>
                <option value='NashVille'>NashVille</option>
                <option value='Nostalgia'>Nostalgia</option>
                <option value='Rise'>Rise</option>
                <option value='Sierra'>Sierra</option>
                <option value='Sutro'>Sutro</option>
                <option value='Toaster'>Toaster</option>
                <option value='Valencia'>Valencia</option>
                <option value='Walden'>Walden</option>
                <option value='Willow'>Willow</option>
                <option value='XPro2'>XPro2</option>
            </select>
        </div>
    </div>

    <div id='image-container'>
        <img id='img' name='image' src='' width='100%'>
    </div>
    <br>

    <div class='row'>
        <div class='form-group'>
            <label for="title" class="control-label col-md-1">Title</label>
            <div class='col-md-8'>
                <input type="text" class="form-control" id="title" name="title" maxlength="20" size="20" value="" required placeholder="Title" autofocus>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='form-group'>
            <label for="text" class="control-label col-md-1">Text</label>
            <div class='col-md-8'>
                <textarea class="form-control" id="text" name="text" maxlength="140" placeholder="140 characters" required style='resize: none'></textarea>
            </div>
        </div>
    </div>

    <input type="submit" value="Create Postcard" class="btn btn-default col-md-offset-1">
</form>