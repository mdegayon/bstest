<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Test Miguel</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css">   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo app\config\Router::getRoute('home')?>">TEST MIGUEL</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo app\config\Router::getRoute('home')?>">Accueil</a></li>
            <li><a href="<?php echo app\config\Router::getRoute('createOrder')?>">S'abonner</a></li>
            <li><a href="#">Le concept</a></li>
            <li><a href="#">Fiches</a></li>
            <li><a href="#">Nos box</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

        <form class="form-horizontal" method="POST" action='<?php echo app\config\Router::getRoute('createOrderRequest'); ?>'>
        <fieldset>

        <!-- Form Name -->
        <legend>S'abonner</legend>
        
        <?php if(array_key_exists('errors', $params)): ?>
        
            <div class="alert alert-danger" role="alert">

                <?php foreach ( $params['errors'] as $currentValidationError ): ?>

                <p>
                    <?php echo $currentValidationError; ?>
                </p>

                <?php endforeach; ?>                                
            </div>
        
        <?php endif; ?>
        
        <?php if(array_key_exists('formSuccess', $params)): ?>
        
            <div class="jumbotron">

                <h1>New Order</h1>
                <div class="alert alert-success" role="alert">
                    <?php echo $params['formSuccess']; ?>                
                </div>
                
            </div>
        
        <?php else: ?>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="email">*Email</label>
              <div class="controls">
                <input id="email" name="email" type="text" placeholder="" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Password input-->
            <div class="control-group">
              <label class="control-label" for="password">*Mot de passe</label>
              <div class="controls">
                <input id="password" name="password" type="password" placeholder="(5 caractères minimum)" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="civility">*Civilité</label>
              <div class="controls">
                <select id="civility" name="civility" class="input-xlarge">
                  <option value="1">Monsieur</option>
                  <option value="2">Madame</option>
                  <option value="3">Mademoiselle</option>
                </select>
              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="lastname">*Nom</label>
              <div class="controls">
                <input id="lastname" name="lastname" type="text" placeholder="" class="input-xlarge">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="firstname">*Prénom</label>
              <div class="controls">
                <input id="firstname" name="firstname" type="text" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="birthdate">*Date de naissance</label>
              <div class="controls">
                <input id="birthdate" name="birthdate" type="text" placeholder="" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="phone">Téléphone</label>
              <div class="controls">
                <input id="phone" name="phone" type="text" placeholder="" class="input-xlarge">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="address">*Adresse</label>
              <div class="controls">
                <input id="address" name="address" type="text" placeholder="" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="address_c_1">Complément d'adresse</label>
              <div class="controls">
                <input id="address_c_1" name="address_c_1" type="text" class="input-xlarge">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="address_c_2">Complément d'adresse 2</label>
              <div class="controls">
                <input id="address_c_2" name="address_c_2" type="text" placeholder="" class="input-xlarge">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="zipcode">CP</label>
              <div class="controls">
                <input id="zipcode" name="zipcode" type="text" placeholder="" class="input-xlarge">

              </div>
            </div>        

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="city">Ville</label>
              <div class="controls">
                <input id="city" name="city" type="text" placeholder="" class="input-xlarge" required="">

              </div>
            </div>

            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="country">Pays</label>
              <div class="controls">
                <select id="country" name="country" class="input-xlarge">
                    <option value="FR">France</option>
                </select>
              </div>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="control-group">
              <label class="control-label" for="conditions"></label>
              <div class="controls">
                <label class="checkbox" for="conditions-0">
                  <input type="checkbox" name="conditions" id="conditions-0" value="1">
                  J'ai plus de 18 ans et j'accepte les Conditions Générales de vente
                </label>
              </div>
            </div>

            <hr>

            <!-- Button -->
            <div class="control-group">

              <div class="controls">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Commander</button>
                </div>        
            </div>        

            </fieldset>
            </form>
        
        <?php endif; ?>

    </div><!-- /.container -->
    
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#birthdate').datepicker({
            format: 'dd/mm/yyyy'
        })
    </script>
    
  </body>
</html>
