<?php
#############################################################################
#                                                                           #
#                                basicPHP                                   #
#                                                                           #
#              wilhelmpaulm's super simple MVC framework tutorial           #
#                                                                           #
#               the actual files in itself is the tutorial                  #
#         if you're patient enough to read about 100+ super simple          #
#           lines of code then you'll master this pretty quickly!           #
#                                                                           #
############################################################################# 

include './lib/config.php';

# clean the URI
$uri = ltrim($_SERVER['REQUEST_URI'], '/');

# split the URI into an array we can use
# split the path by '/'
$params = explode("/", $uri);
$params_count = count($params);

# select what route type you want to use
# file or function
$route_type = "file";

# keeps users from requesting any file they want
$safe_pages = ['index', 'login', 'logout', 'sample'];

# if route_type is set to file
# it will search for that file and use the functions inside that file
# if it doesnt find it then it would send a 404 page
if ($route_type == 'file') {
    $file_link = "./controller/" . $uri . ".php";
    if (file_exists($file_link) && in_array($params[0], $safe_pages)) {
        try {
            include($file_link);
        } catch (Exception $exc) {
            # echo $exc->getTraceAsString();
            include($page["404"]);
        }
    } else {
        include($page["404"]);
    }
}
