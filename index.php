<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Cover Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/cover/cover.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </head>

  <body>

    <div class="site-wrapper" style="background-color: #250000;">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Grammar</h3>
            </div>
          </div>

          <div class="inner cover">
            <p class="lead">
              <?php
                function __autoload($class_name) {
                  require_once './assets/' . $class_name . '.php';
                }

                /*
                  Dummy example
                 */
                $input = json_decode(file_get_contents("./grammar.json"));

                //Print the gramamr
                print '<b>Grammar:</b> <br />';
                foreach ($input->states as $state) {
                  print $state->name . ' -> ';
                  foreach ($state->path as $key => $value) {
                    if($key != 0) print ' | ';
                    print $value;
                  }
                  print '<br />';
                }
                print '<hr />';

                //Load the grammar
                $gr = new CheckGrammar($input);
                //Run the grammar
                $result = $gr->run();

                //Print the accepted words
                if( count($result['accepted_words']) ) {
                  print 'Accepted words: ';
                  foreach ($result['accepted_words'] as $key => $word) {
                    if($key != 0) print ', ';
                    print $word;
                  }
                  print "<br />";
                }

                //Print the rejected words
                if( count($result['rejected_words']) ) {
                  print 'Rejected words: ';
                  foreach ($result['rejected_words'] as $key => $word) {
                    if($key != 0) print ', ';
                    print $word;
                  }
                }

              ?>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p><a href="https://statescu.net">@Statescu Razvan</a></p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="http://v4-alpha.getbootstrap.com/assets/js/vendor/jquery.min.js"></script>')</script>
    <script src="http://v4-alpha.getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>


  </body>
</html>
