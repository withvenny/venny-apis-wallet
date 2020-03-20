<?php

    //
    header('Content-Type: application/json');

    //
    use Core\Connection as Connection;
    use Core\Token as Token;
    use Identity\User as User;

    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();

    // STEP 1. Receive passed variables / information
    if(isset($_REQUEST['app'])){$request['app'] = clean($_REQUEST['app']);}
    if(isset($_REQUEST['domain'])){$request['domain'] = clean($_REQUEST['domain']);}
    if(isset($_REQUEST['token'])){$request['token'] = clean($_REQUEST['token']);}

    // INITIATE DATA CLEANSE
    if(isset($_REQUEST['id'])){$request['id'] = clean($_REQUEST['id']);}		
    if(isset($_REQUEST['attributes'])){$request['attributes'] = clean($_REQUEST['attributes']);}		
    if(isset($_REQUEST['body'])){$request['body'] = clean($_REQUEST['body']);}		
    if(isset($_REQUEST['images'])){$request['images'] = clean($_REQUEST['images']);}		
    if(isset($_REQUEST['deleted'])){$request['deleted'] = clean($_REQUEST['deleted']);}

    //
    switch ($_SERVER['REQUEST_METHOD']) {

        //
        case 'POST':

            try {

                // 
                $user = new User($pdo);
            
                // insert a stock into the stocks table
                $id = $user->insertUser($request);

                $request['id'] = $id;

                $results = $user->selectUsers($request);

                $results = json_encode($results);
                
                //
                echo $results;
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'GET':

            //
            if(isset($_REQUEST['per'])){$request['per'] = clean($_REQUEST['per']);}
            if(isset($_REQUEST['page'])){$request['page'] = clean($_REQUEST['page']);}
            if(isset($_REQUEST['limit'])){$request['limit'] = clean($_REQUEST['limit']);}        

            try {

                // 
                $user = new User($pdo);

                // get all stocks data
                $results = $user->selectUsers($request);

                $results = json_encode($results);

                echo $results;

            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'PUT':

            try {

                // 
                $user = new User($pdo);
            
                // insert a stock into the stocks table
                $id = $user->updateUser($request);

                $request['id'] = $id;

                $results = $user->selectUsers($request);

                $results = json_encode($results);

                echo $results;
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'DELETE':

            try {

                // 
                $user = new User($pdo);
            
                // insert a stock into the stocks table
                $id = $user->deleteUser($request);

                echo 'The record ' . $id . ' has been deleted';
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

    }

?>
